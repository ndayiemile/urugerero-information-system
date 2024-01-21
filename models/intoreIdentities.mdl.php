<?php
class IntoreIdentities
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getIntoreIdentities(...$arguments)
    {
        $tuples = ["*"];
        return $this->db->selectAnd("intoreIdentities", $tuples, $arguments);
    }
    public function getIntoreStatusBadge(...$arguments)
    {
        $queryString = '
        SELECT status FROM (
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
            HAVING id = :intoreId
            ORDER BY id, priority 
        ';
        $this->db->query($queryString);
        // bind the values to the query
        $this->db->bind(':intoreId', $arguments["id"]);
        return $this->db->resultSet();
    }
    public function getIntoreResponsibilities(...$arguments)
    {
        $queryString = '
            SELECT title,description,DATE(responsibilities.`startDate`) as `startDate`, DATE(responsibilities.`endDate`) AS `endDate` FROM intoreRelations
            LEFT JOIN responsibilities
            ON intoreRelations.`entryId` = responsibilities.id
            WHERE `entityName` = "responsibilities" AND `intoreId` = :intoreId
        ';
        $this->db->query($queryString);
        // bind the values to the query
        $this->db->bind(':intoreId', $arguments["id"]);
        return $this->db->resultSet();
    }
    public function getIntoreHonors(...$arguments)
    {
        $queryString = '
            SELECT title,description, DATE(honors.`dueDate`) AS `dueDate` FROM intoreRelations
            LEFT JOIN honors
            ON intoreRelations.`entryId` = honors.id
            WHERE `entityName` = "honors" AND `intoreId` = :intoreId
        ';
        $this->db->query($queryString);
        // bind the values to the query
        $this->db->bind(':intoreId', $arguments["id"]);
        return $this->db->resultSet();
    }
    public function getIntoreMisconducts(...$arguments)
    {
        $queryString = '
            SELECT title,description,DATE(misconducts.`dueDate`) AS `dueDate` FROM intoreRelations
            LEFT JOIN misconducts
            ON intoreRelations.`entryId` = misconducts.id
            WHERE `entityName` = "misconducts" AND `intoreId` = :intoreId
        ';
        $this->db->query($queryString);
        // bind the values to the query
        $this->db->bind(':intoreId', $arguments["id"]);
        return $this->db->resultSet();
    }
    public function getIntoreAttendanceRate(...$arguments)
    {
        $queryString = '
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
        WHERE id = :intoreId
        ';
        $this->db->query($queryString);
        // bind the values to the query
        $this->db->bind(':intoreId', $arguments["id"]);
        return $this->db->resultSet();
    }
    public function getIntorePermissions(...$arguments){
        $queryString = '
        SELECT Iit.id, COUNT(`entryId`) as total FROM `intoreIdentities` Iit
        LEFT JOIN `intoreRelations` Irt
        ON Iit.id = Irt.`intoreId` AND Irt.`entityName` = "permissions"
        WHERE id = :intoreId
        GROUP BY Iit.id
        ';    
        $this->db->query($queryString);
        // bind the values to the query
        $this->db->bind(':intoreId', $arguments["id"]);
        return $this->db->resultSet();
    }
    public function getIntoreAdditionalInfo(...$arguments){
        $tuples = ["additionalInfo"];
        // bind the values to the query
        return $this->db->selectAnd("intoreIdentities",$tuples,$arguments);
    }
}