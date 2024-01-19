-- gets the number of intore in each cell
SELECT cell, COUNT(*) AS total FROM `intoreIdentities` GROUP BY cell;
-- gets the number of attended activities in cell activities
SELECT participant as cell, COUNT(*) as attendees,activities.`dueDate`
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
    activities.`dueDate`;

-- gets number of participants in each sector activity grouped by their cells
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
GROUP BY cell,activities.`dueDate`;

-- combines the the intore number of intore who attended both sector and cell activities // GROUP BY cells

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
ORDER BY cell, `dueDate`;

