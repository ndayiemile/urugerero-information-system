<?php
class Home
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getNumberOfActivitiesAndRegisteredIntore(...$arguments)
    {
        $tuples = ["COUNT(*) AS count"];
        return ["activities" => (int)$this->db->selectAnd("activities", $tuples, $arguments)[0]->count, "intore" => (int)$this->db->selectAnd("intoreIdentities", $tuples, $arguments)[0]->count];
    }

    public function getCellAttendanceProgression(...$arguments)
    {
        // get the attendance numbers for activities participants
        $queryString = '
            SELECT entryId,dueDate as regDate,cell as participant,count(*) as attendees FROM (SELECT entryId, a.dueDate, intoreId FROM intoreRelations i
            LEFT JOIN activities a
            ON a.id = i.entryId
            WHERE i.entityName = "activities") as activitiesData
            LEFT JOIN intoreIdentities ii
            ON activitiesData.intoreId = ii.id
            GROUP BY entryId
            HAVING dueDate >= :startDate AND dueDate <= :endDate
        ';
        $this->db->query($queryString);
        // bind the values to the query
        foreach ($arguments as $name => $value) {
            $this->db->bind(':' . $name, $value);
        }

        // get all the number of members in each participant groups
        $DB2 = new Database;
        $queryString1 = '
        SELECT count(*) as count,cell as participant FROM `intoreIdentities` GROUP BY cell
        union
        select (select count(*) from intoreIdentities where sector = "Kimisagara"),"Sector";
        ';
        $DB2->query($queryString1);

        return ["relationsData" => $this->db->resultSet(), "groupData" => $DB2->resultSet()];
    }
    public function getSectorDataOverView(...$arguments)
    {
        $queryString = '
            SELECT p.category as status,
                COUNT(*) as counts
            FROM intoreRelations i
                LEFT JOIN permissions p ON i.entryId = p.id
            WHERE entityName = "permissions"
                AND p.startDate >= "2022-01-04"
                AND p.endDate <= "2024-12-12"
                AND i.intoreId NOT IN (
                    SELECT intoreId
                    from (
                            SELECT intoreId,
                                count(*) as timesAttended,
                                a.participant
                            FROM intoreRelations i
                                LEFT JOIN activities a ON i.entryId = a.id
                            WHERE entityName = "activities"
                                AND a.dueDate >= "2022-01-04"
                                AND a.dueDate <= "2024-12-12"
                            GROUP BY intoreId
                        ) as activeIntore
                    WHERE timesAttended > (
                            SELECT COUNT(*)
                            FROM activities
                            WHERE participant = activeIntore.participant
                                AND dueDate >= "2013-02-02"
                                AND dueDate <= "2025-12-12"
                            GROUP by participant
                        ) / 2
                )
            GROUP BY entryId
            UNION
            SELECT "active",count(*)
            from (
                    SELECT intoreId, count(*) as timesAttended,
                        a.participant
                    FROM intoreRelations i
                        LEFT JOIN activities a ON i.entryId = a.id
                    WHERE entityName = "activities"
                        AND a.dueDate >= "2022-01-04"
                        AND a.dueDate <= "2024-12-12"
                    GROUP BY intoreId
                ) as activeIntore
            WHERE timesAttended > (
                    SELECT COUNT(*)
                    FROM activities
                    WHERE participant = activeIntore.participant
                        AND dueDate >= "2013-02-02"
                        AND dueDate <= "2025-12-12"
                    GROUP by participant
            )/2
            UNION
            SELECT "inactive",(SELECT count(*) FROM intoreIdentities) - (SELECT SUM(counts) FROM (SELECT p.category as status,
                COUNT(*) as counts
            FROM intoreRelations i
                LEFT JOIN permissions p ON i.entryId = p.id
            WHERE entityName = "permissions"
                AND p.startDate >= "2022-01-04"
                AND p.endDate <= "2024-12-12"
                AND i.intoreId NOT IN (
                    SELECT intoreId
                    from (
                            SELECT intoreId,
                                count(*) as timesAttended,
                                a.participant
                            FROM intoreRelations i
                                LEFT JOIN activities a ON i.entryId = a.id
                            WHERE entityName = "activities"
                                AND a.dueDate >= "2022-01-04"
                                AND a.dueDate <= "2024-12-12"
                            GROUP BY intoreId
                        ) as activeIntore
                    WHERE timesAttended > (
                            SELECT COUNT(*)
                            FROM activities
                            WHERE participant = activeIntore.participant
                                AND dueDate >= "2013-02-02"
                                AND dueDate <= "2025-12-12"
                            GROUP by participant
                        ) / 2
                )
            GROUP BY entryId
            UNION
            SELECT "active",count(*)
            from (
                    SELECT intoreId, count(*) as timesAttended,
                        a.participant
                    FROM intoreRelations i
                        LEFT JOIN activities a ON i.entryId = a.id
                    WHERE entityName = "activities"
                        AND a.dueDate >= "2022-01-04"
                        AND a.dueDate <= "2024-12-12"
                    GROUP BY intoreId
                ) as activeIntore
            WHERE timesAttended > (
                    SELECT COUNT(*)
                    FROM activities
                    WHERE participant = activeIntore.participant
                        AND dueDate >= "2013-02-02"
                        AND dueDate <= "2025-12-12"
                    GROUP by participant
            )/2) as knownData)
        ';
        $this->db->query($queryString);
        return $this->db->resultSet();
    }

    public function getIntoreAttendanceClassificationByCell(...$arguments)
    {
        $queryString = '
            SELECT intoreId,count(intoreId) as attendance,cell as participant FROM intoreIdentities ii
            LEFT JOIN intoreRelations ir
            ON ii.id = ir.intoreId
            WHERE entityName = "activities"
            GROUP BY id
        ';

        $this->db->query($queryString);
        // get all the number of members in each participant groups
        $DB2 = new Database;
        $queryString1 = '
            SELECT participant,
                count(*) + (
                    SELECT count(*)
                    FROM activities
                    WHERE participant = "sector"
                    GROUP BY participant
                ) AS numberOfActivities
            FROM activities
            WHERE participant <> "sector"
            GROUP BY participant
        ';
        $DB2->query($queryString1);
        return ["relationsData" => $this->db->resultSet(), "groupData" => $DB2->resultSet()];
    }
    public function getSectorActivitiesDataOverView(...$arguments)
    {
        $queryString ='
            SELECT category,count(*) as count FROM activities
            WHERE dueDate >= "2023-10-10" AND dueDate <= "2025-10-10"
            GROUP BY category 
        ';
        $this->db->query($queryString);
        return $this->db->resultSet();
    }

    public function getDoneActivities(...$arguments){
        $tuples = ["id,title,dueDate"];
        return $this->db->selectAnd("activities", $tuples, $arguments);
    }
}
