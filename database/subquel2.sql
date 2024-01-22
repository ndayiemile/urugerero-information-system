SELECT cell, 
CASE 
WHEN percentageAttendance BETWEEN 75 AND 100 THEN "75-100"
WHEN percentageAttendance BETWEEN 50 AND 74 THEN "50-75"
WHEN percentageAttendance BETWEEN 25 AND 49 THEN "25-50"
ELSE "0-25"
END as category,
count(*) AS catMembers
FROM (
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
    ) AS mainDataSet
    JOIN (SELECT COUNT(*) as sector FROM intoreIdentities) as sectorIntoreCount
    GROUP BY cell,category
 