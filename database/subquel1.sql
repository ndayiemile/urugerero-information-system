SELECT * FROM (SELECT * FROM (SELECT participant as cell, COUNT(*) as attendees,activities.`dueDate`
FROM
    `intoreRelations`
    LEFT JOIN activities ON intoreRelations.`entryId` = activities.id
WHERE
    `entityName` = "activities"
    AND activities.`dueDate` >= "2024-01-01"
    AND activities.`dueDate` <= "2024-01-05"
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
    AND activities.`dueDate` >= "2024-01-01"
    AND activities.`dueDate` <= "2024-01-07"
    AND activities.participant = "sector"
GROUP BY cell,activities.`dueDate`) as cellAndSectorActivitiesAttenders
ORDER BY cell, `dueDate`
