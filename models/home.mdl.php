<?php
class Home
{
    private $db;
    private $queryForIntoreId_Status_cell_realAttendance_expectedAttendance_percentageAttendance;
    public function __construct()
    {
        $this->db = new Database;
        $this->queryForIntoreId_Status_cell_realAttendance_expectedAttendance_percentageAttendance = '
        SELECT
            id, status, cell, realAttendance, expectedAttendance, ROUND(
                (
                    realAttendance / expectedAttendance
                ) * 100
            ) AS percentageAttendance
        FROM (
                SELECT
                    id, status, cell, timesAttended AS realAttendance, total AS expectedAttendance
                FROM (
                        SELECT Iit.id, status, cell, IF(
                                ISNULL(`entryId`), 0, COUNT(*)
                            ) AS timesAttended
                        FROM (
                                SELECT id, status
                                FROM (
                                        SELECT id, category AS status, 1 AS priority
                                        FROM (
                                                SELECT Iit.id, Iit.cell, Pt.category, Pt.description, Pt.`startDate`, Pt.`endDate`
                                                FROM
                                                    `intoreIdentities` Iit
                                                    INNER JOIN `intoreRelations` Irt ON Iit.`id` = Irt.`intoreId`
                                                    AND Irt.`entityName` = "permissions"
                                                    INNER JOIN permissions Pt ON Pt.id = Irt.`entryId`
                                                WHERE
                                                    Pt.`startDate` <= CURDATE()
                                                    AND Pt.`endDate` >= CURDATE()
                                            ) AS intoreWithPermission
                                        UNION
                                        SELECT Iit.id, IF(
                                                ROUND(
                                                    (
                                                        COUNT(*) / (
                                                            SELECT (
                                                                    actTotal + (
                                                                        SELECT COUNT(*)
                                                                        FROM activities
                                                                        WHERE
                                                                            participant = "sector"
                                                                    )
                                                                ) AS total
                                                            FROM (
                                                                    SELECT *
                                                                    FROM (
                                                                            SELECT participant, COUNT(*) AS actTotal
                                                                            FROM activities
                                                                            GROUP BY
                                                                                participant
                                                                            HAVING
                                                                                participant <> "sector"
                                                                        ) AS cellsWithActivities
                                                                    UNION
                                                                    SELECT cell, 0 AS COUNT
                                                                    FROM `intoreIdentities`
                                                                    WHERE
                                                                        cell NOT IN(
                                                                            SELECT DISTINCT
                                                                                participant
                                                                            FROM activities
                                                                        )
                                                                ) AS allCells
                                                            WHERE
                                                                participant = Iit.cell
                                                        )
                                                    ) * 100
                                                ) > 50, "Active", "Inactive"
                                            ) AS status, 2
                                        FROM
                                            `intoreIdentities` Iit
                                            INNER JOIN `intoreRelations` Irt ON Iit.id = Irt.`intoreId`
                                        WHERE
                                            Irt.`entityName` = "activities"
                                        GROUP BY
                                            Iit.id
                                        UNION
                                        SELECT id, "Inactive", 2
                                        FROM `intoreIdentities`
                                        WHERE
                                            id NOT IN(
                                                SELECT DISTINCT
                                                    intoreId
                                                FROM `intoreRelations`
                                                WHERE
                                                    `entityName` = "activities"
                                            )
                                    ) AS allIntoreStatus
                                GROUP BY
                                    id
                                ORDER BY id, priority
                            ) AS intoreWithStatus
                            INNER JOIN `intoreIdentities` Iit ON Iit.id = intoreWithStatus.id
                            LEFT JOIN `intoreRelations` Irt ON Iit.id = Irt.`intoreId`
                            AND Irt.`entityName` = "activities"
                        GROUP BY
                            id
                    ) AS intoreStatusWithCellsAndNumberOfAttendedActivities
                    LEFT JOIN (
                        SELECT participant, (
                                actTotal + (
                                    SELECT COUNT(*)
                                    FROM activities
                                    WHERE
                                        participant = "sector"
                                )
                            ) AS total
                        FROM (
                                SELECT *
                                FROM (
                                        SELECT participant, COUNT(*) AS actTotal
                                        FROM activities
                                        GROUP BY
                                            participant
                                        HAVING
                                            participant <> "sector"
                                    ) AS cellsWithActivities
                                UNION
                                SELECT cell, 0 AS COUNT
                                FROM `intoreIdentities`
                                WHERE
                                    cell NOT IN(
                                        SELECT DISTINCT
                                            participant
                                        FROM activities
                                    )
                            ) AS allCells
                    ) AS activitiesDoneByEachCell ON intoreStatusWithCellsAndNumberOfAttendedActivities.cell = activitiesDoneByEachCell.participant
            ) AS intoreDataWithRealAndExpectedAttendance
    ';
    }
    public function getNumberOfActivitiesAndRegisteredIntore(...$arguments)
    {
        $tuples = ["COUNT(*) AS count"];
        return ["activities" => (int)$this->db->selectAnd("activities", $tuples, $arguments)[0]->count, "intore" => (int)$this->db->selectAnd("intoreIdentities", $tuples, $arguments)[0]->count];
    }

    public function getCellAttendanceProgression(...$arguments)
    {
        // combines the the intore number of intore who attended both sector and cell activities // GROUP BY cells
        $queryString = '
        SELECT * FROM (SELECT * FROM (SELECT participant as cell, COUNT(*) as attendees,activities.`dueDate`
        FROM
            `intoreRelations`
            LEFT JOIN activities ON intoreRelations.`entryId` = activities.id
        WHERE
            `entityName` = "activities"
            AND activities.`dueDate` >= :startDate
            AND activities.`dueDate` <= :endDate
            AND activities.participant <> "sector"
        GROUP BY
            activities.participant, activities.`dueDate`
        ORDER BY 
            activities.`dueDate`) as cellActivityAttendees
        UNION
        SELECT cell,COUNT(*) as attendees,activities.`dueDate`
        FROM
            `intoreRelations`
            LEFT JOIN activities ON intoreRelations.`entryId` = activities.id
            LEFT JOIN `intoreIdentities` ON intoreIdentities.id = intoreRelations.`intoreId`
        WHERE
            `entityName` = "activities"
            AND activities.`dueDate` >= :startDate
            AND activities.`dueDate` <= :endDate
            AND activities.participant = "sector"
        GROUP BY cell,activities.`dueDate`) as cellAndSectorActivitiesAttenders
        ORDER BY cell, `dueDate`        
        ';
        $this->db->query($queryString);
        // bind the values to the query
        foreach ($arguments as $name => $value) {
            $this->db->bind(':' . $name, $value);
        }

        //gets the number of intore in each cell
        $DB2 = new Database;
        $queryString1 = '
        SELECT cell, COUNT(*) AS count FROM `intoreIdentities` GROUP BY cell;
        ';
        $DB2->query($queryString1);

        return ["cellAttendees" => $this->db->resultSet(), "cellMembers" => $DB2->resultSet()];
    }
    public function getSectorDataOverView(...$arguments)
    {
        $queryString = "
        SELECT status,ROUND((count(*) / sector)*100) AS categoryPercentage
        FROM ($this->queryForIntoreId_Status_cell_realAttendance_expectedAttendance_percentageAttendance) 
        AS mainDataSet
        JOIN (SELECT COUNT(*) as sector FROM intoreIdentities) as sectorIntoreCount
        GROUP BY status
        ";
        $this->db->query($queryString);
        try {
            return $this->db->resultSet();
        } catch (Throwable $e) {
            array_push($GLOBALS['debugger'], ["message" => $e->getMessage(), "Throwable" => $e, "dbQuery" => $queryString]);
        }
    }
    public function getIntoreAttendanceClassificationByCell(...$arguments)
    {
        $queryString = "
        SELECT cell, 
            CASE 
            WHEN percentageAttendance BETWEEN 75 AND 100 THEN 'A'
            WHEN percentageAttendance BETWEEN 50 AND 74 THEN 'B'
            WHEN percentageAttendance BETWEEN 25 AND 49 THEN 'C'
            ELSE 'D'
            END as category,
            count(*) AS catCount
        FROM ($this->queryForIntoreId_Status_cell_realAttendance_expectedAttendance_percentageAttendance) 
        AS mainDataSet
        GROUP BY cell,category
        ";
        $this->db->query($queryString);
        try {
            return $this->db->resultSet();
        } catch (Throwable $e) {
            array_push($GLOBALS['debugger'], ["message" => $e->getMessage(), "Throwable" => $e, "dbQuery" => $queryString]);
        }
    }
    public function getSectorActivitiesDataOverView(...$arguments)
    {
        $queryString = '
            SELECT category,count(*) as count FROM activities
            WHERE dueDate >= "2023-10-10" AND dueDate <= "2025-10-10"
            GROUP BY category 
        ';
        $this->db->query($queryString);
        return $this->db->resultSet();
    }

    public function getDoneActivities(...$arguments)
    {
        $tuples = ["id,title,dueDate"];
        return $this->db->selectAnd("activities", $tuples, $arguments);
    }
}
