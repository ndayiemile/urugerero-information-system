SELECT * FROM (
                SELECT Iit3.id,`cohortId`,`fullName`,`nationalId`,gender,mother,father,`martialStatus`,height,mass,bmi,pressure,vaccination,district,sector,cell,village,`firstTel`,`secondTel`,email,school,combination,`additionalInfo`,status FROM (SELECT id,status FROM (
                SELECT id,category as status,1 as priority FROM (SELECT Iit.id,Iit.cell,Pt.category,Pt.description,Pt.`startDate`,Pt.`endDate` FROM `intoreIdentities` Iit
                INNER JOIN `intoreRelations` Irt
                ON Iit.`id` = Irt.`intoreId` AND Irt.`entityName` = 'permissions'
                INNER JOIN permissions Pt 
                ON Pt.id = Irt.`entryId`
                WHERE Pt.`startDate` <= CURDATE() AND Pt.`endDate` >= CURDATE()) as intoreWithPermission
                UNION
                SELECT Iit.id,IF(ROUND((COUNT(*) / (SELECT (actTotal + (SELECT COUNT(*) FROM activities WHERE participant = 'sector')) AS total FROM (SELECT * FROM (SELECT participant,COUNT(*) as actTotal FROM activities
                GROUP BY participant
                HAVING participant <> 'sector') AS cellsWithActivities
                UNION
                SELECT cell, 0 AS count FROM `intoreIdentities`
                WHERE cell NOT IN (SELECT DISTINCT participant FROM activities)) as allCells
                WHERE participant = Iit.cell))*100) > 50,'Active','Inactive') as status,2
                FROM `intoreIdentities` Iit
                INNER JOIN `intoreRelations` Irt
                ON Iit.id = Irt.`intoreId`
                WHERE Irt.`entityName` = 'activities' 
                GROUP BY Iit.id
                UNION
                SELECT id,'Inactive',2 FROM `intoreIdentities` WHERE id NOT IN (SELECT DISTINCT intoreId FROM `intoreRelations`
                WHERE `entityName` = 'activities')
                ) as allIntoreStatus
                GROUP BY id
                ORDER BY id, priority) intoreWithStatus
                LEFT JOIN `intoreIdentities` Iit3
                ON intoreWithStatus.id = Iit3.id
            ) AS intoreData WHERE cell = "Kimisagara" AND status = "Sick" ORDER BY id ASC LIMIT 50;