-- gets intore with permissions
SELECT id,category as status FROM (SELECT Iit.id,Iit.cell,Pt.category,Pt.description,Pt.`startDate`,Pt.`endDate` FROM `intoreIdentities` Iit
INNER JOIN `intoreRelations` Irt
ON Iit.`id` = Irt.`intoreId` AND Irt.`entityName` = "permissions"
INNER JOIN permissions Pt 
ON Pt.id = Irt.`entryId`
WHERE Pt.`startDate` <= "2024-01-04" AND Pt.`endDate` >= "2024-01-04") as intoreWithPermission;
-- gets intore Without permission but attended some sessions
SELECT Iit.id,IF(ROUND((COUNT(*) / (SELECT (actTotal + (SELECT COUNT(*) FROM activities WHERE participant = "sector")) AS total FROM (SELECT * FROM (SELECT participant,COUNT(*) as actTotal FROM activities
GROUP BY participant
HAVING participant <> "sector") AS cellsWithActivities
UNION
SELECT cell, 0 AS count FROM `intoreIdentities`
WHERE cell NOT IN (SELECT DISTINCT participant FROM activities)) as allCells
WHERE participant = Iit.cell))*100) > 50,"Active","Inactive") as status
FROM `intoreIdentities` Iit
INNER JOIN `intoreRelations` Irt
ON Iit.id = Irt.`intoreId`
WHERE Irt.`entityName` = "activities" 
GROUP BY Iit.id;
--gets intore who attended no any activity
SELECT id,cell,"Inactive" FROM `intoreIdentities` WHERE id NOT IN (SELECT DISTINCT intoreId FROM `intoreRelations`
WHERE `entityName` = "activities")

--gets the activities done by each cell
SELECT participant,(COUNT(*) + (SELECT COUNT(*) FROM activities WHERE participant = "sector")) AS total FROM activities
GROUP BY participant
HAVING participant <> "sector"

SELECT participant,(actTotal + (SELECT COUNT(*) FROM activities WHERE participant = "sector")) AS total FROM (SELECT * FROM (SELECT participant,COUNT(*) as actTotal FROM activities
GROUP BY participant
HAVING participant <> "sector") AS cellsWithActivities
UNION
SELECT cell, 0 AS count FROM `intoreIdentities`
WHERE cell NOT IN (SELECT DISTINCT participant FROM activities)) as allCells
WHERE participant = "Kamuhoza";

-- combines permissioned and none permissioned `intoreId`
SELECT * FROM (SELECT id,status FROM (
SELECT id,category as status,1 as priority FROM (SELECT Iit.id,Iit.cell,Pt.category,Pt.description,Pt.`startDate`,Pt.`endDate` FROM `intoreIdentities` Iit
INNER JOIN `intoreRelations` Irt
ON Iit.`id` = Irt.`intoreId` AND Irt.`entityName` = "permissions"
INNER JOIN permissions Pt 
ON Pt.id = Irt.`entryId`
WHERE Pt.`startDate` <= CURDATE() AND Pt.`endDate` >= CURDATE()) as intoreWithPermission
UNION
SELECT Iit.id,IF(ROUND((COUNT(*) / (SELECT (actTotal + (SELECT COUNT(*) FROM activities WHERE participant = "sector")) AS total FROM (SELECT * FROM (SELECT participant,COUNT(*) as actTotal FROM activities
GROUP BY participant
HAVING participant <> "sector") AS cellsWithActivities
UNION
SELECT cell, 0 AS count FROM `intoreIdentities`
WHERE cell NOT IN (SELECT DISTINCT participant FROM activities)) as allCells
WHERE participant = Iit.cell))*100) > 50,"Active","Inactive") as status,2
FROM `intoreIdentities` Iit
INNER JOIN `intoreRelations` Irt
ON Iit.id = Irt.`intoreId`
WHERE Irt.`entityName` = "activities" 
GROUP BY Iit.id
UNION
SELECT id,"Inactive",2 FROM `intoreIdentities` WHERE id NOT IN (SELECT DISTINCT intoreId FROM `intoreRelations`
WHERE `entityName` = "activities")
) as allIntoreStatus
GROUP BY id
ORDER BY id, priority) intoreWithStatus
LEFT JOIN `intoreIdentities` Iit3
ON intoreWithStatus.id = Iit3.id 

--

SELECT AtFP.id,AtFP.`dueDate`,IitFP.cell,COUNT(*) AS count,(SELECT count(category) as hadPermission FROM (SELECT Iit.id,Iit.cell,Pt.category,Pt.description,Pt.`startDate`,Pt.`endDate` FROM `intoreIdentities` Iit
INNER JOIN `intoreRelations` Irt
ON Iit.`id` = Irt.`intoreId` AND Irt.`entityName` = "permissions"
INNER JOIN permissions Pt 
ON Pt.id = Irt.`entryId`
WHERE Pt.`startDate` <= AtFP.`dueDate` AND Pt.`endDate` >= AtFP.`dueDate`) as intoreWithPermission
WHERE id =  15) AS permissionState FROM activities AtFP
INNER JOIN `intoreRelations` IrtFP
ON AtFP.id = IrtFP.`entryId`
INNER JOIN `intoreIdentities` IitFP
ON IitFP.id = IrtFP.`intoreId`
WHERE IrtFP.`entityName` = "activities"
GROUP BY IrtFP.`intoreId`, AtFP.id
ORDER BY IrtFP.`intoreId`

-- gets intore with permissions
SELECT count(category) as hadPermission FROM (SELECT Iit.id,Iit.cell,Pt.category,Pt.description,Pt.`startDate`,Pt.`endDate` FROM `intoreIdentities` Iit
INNER JOIN `intoreRelations` Irt
ON Iit.`id` = Irt.`intoreId` AND Irt.`entityName` = "permissions"
INNER JOIN permissions Pt 
ON Pt.id = Irt.`entryId`
WHERE Pt.`startDate` <= "2024-01-04" AND Pt.`endDate` >= "2024-01-04") as intoreWithPermission
WHERE id =  4
-- combines all intore attendance data
DELIMITER $$
CREATE FUNCTION sampleFnc(id INT,currDate DATE)
RETURNS INT DETERMINISTIC
BEGIN
DECLARE resId INT;
SET resId = (SELECT count(category) as hadPermission FROM (SELECT Iit.id,Iit.cell,Pt.category,Pt.description,Pt.`startDate`,Pt.`endDate` FROM `intoreIdentities` Iit
INNER JOIN `intoreRelations` Irt
ON Iit.`id` = Irt.`intoreId` AND Irt.`entityName` = "permissions"
INNER JOIN permissions Pt 
ON Pt.id = Irt.`entryId`
WHERE Pt.`startDate` <= "2024-01-04" AND Pt.`endDate` >= "2024-01-04") as intoreWithPermission
WHERE id =  4);
RETURN id;
END$$

-- query to get intore attendance rate
SELECT id,cell, ROUND(IF(realAttendance <> 0,realAttendance/expectedAttendance,0)*100) AS percentage FROM (SELECT id,realAttendance,
(SELECT (actTotal + (SELECT COUNT(*) FROM activities WHERE participant = "sector")) AS total FROM (SELECT * FROM (SELECT participant,COUNT(*) as actTotal FROM activities
GROUP BY participant
HAVING participant <> "sector") AS cellsWithActivities
UNION
SELECT cell, 0 AS count FROM `intoreIdentities`
WHERE cell NOT IN (SELECT DISTINCT participant FROM activities)) as allCells
WHERE participant = attendanceData.cell) AS expectedAttendance,cell
FROM (SELECT Iit.id, COUNT(*) AS realAttendance, Iit.cell
FROM `intoreIdentities` Iit 
LEFT JOIN `intoreRelations` Irt 
ON Iit.id = Irt.`intoreId` 
WHERE `entityName` = "activities"
GROUP BY Iit.id
UNION
SELECT DISTINCT id, 0 AS attendace,cell FROM `intoreIdentities` WHERE id NOT IN(SELECT DISTINCT `intoreId` FROM `intoreRelations` Irt2 
WHERE Irt2.`entityName` = "activities")) AS attendanceData) WithPercentages
WHERE id = 15

SELECT Iit.id, COUNT(`entryId`) as total FROM `intoreIdentities` Iit
LEFT JOIN `intoreRelations` Irt
ON Iit.id = Irt.`intoreId` AND Irt.`entityName` = "permissions"
WHERE id = 15
GROUP BY Iit.id