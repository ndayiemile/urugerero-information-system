<?php
class Intore
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getIntoreIdentities(...$arguments)
    {
        $queryString = '
            SELECT Iit3.id,`cohortId`,`fullName`,`nationalId`,gender,mother,father,`martialStatus`,height,mass,bmi,pressure,vaccination,district,sector,cell,village,`firstTel`,`secondTel`,email,school,combination,`additionalInfo`,status FROM (SELECT id,status FROM (
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
            ';
        $this->db->query($queryString);
        // bind the values to the query
        return $this->db->resultSet();
    }
    public function sortKeys(...$arguments)
    {
        /* sortKeys actions*/
        define("sortAction", $arguments['action']);
        unset($arguments['action']);
        //getSortKeys
        if (sortAction == "getSortKeys") {
            //default sortKeyNames
            $propertySortKeys = ["property", "gender", "martialStatus", "vaccination", "school", "combination"];
            $locationSortKeys = ["location", "district", "sector", "cell", "village"];
            $currentStatusSortKeys = ["All", "Active", "Employed", "Sick", "Studying","Inactive"];

            $sortKeys = ["propertySortKeys" => $propertySortKeys, "locationSortKeys" => $locationSortKeys, "currentStatusSortKeys" => $currentStatusSortKeys];
            return $sortKeys;
        }
        //getSortOptionValues
        if (sortAction == "getSortOptionValues") {
            $optionKey = $arguments['optionKey'];
            $query = "SELECT DISTINCT " . $optionKey . " FROM intoreIdentities";
            $this->db->query($query);
            //return the sortOptionValues
            return $this->db->resultSet();
        }
        // perform sort operation
        if (sortAction == "performSorting") {
            $whereClause = " WHERE ";
            $entries = $arguments['numberOfEntries'];
            $bindsSet = array();
            $unworkableFieldValues = array("undefined", null, "", "All", "null");
            $unworkableFieldNames = array("location", "property");
            // filter the sort arguments
            foreach ($arguments as $key => $value) {
                if ($key != 'numberOfEntries') {
                    $data = explode(',', $value);
                    $fieldName = $data[0];
                    $fieldValue = $data[1];
                    if (!in_array($fieldName, $unworkableFieldNames)) {
                        if (!in_array($fieldValue, $unworkableFieldValues)) {
                            $whereClause .= " " . $fieldName . " = :" . $fieldName . " AND";
                            $bindsSet[$fieldName] = $fieldValue;
                        }
                    }
                }
            }
            // removes trailing AND
            $whereClause = chop($whereClause, " AND ");
            // removes trailing where in case
            $whereClause = chop($whereClause, " WHERE");
            // query
            $query = "SELECT * FROM (
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
            ) AS intoreData" . $whereClause . " ORDER BY id ASC LIMIT " . $entries;
            // prepares the query
            $this->db->query($query);
            // bind the values if any
            //bind the values to the query
            foreach ($bindsSet as $name => $value) {
                $this->db->bind(':' . $name, $value);
            }
            //return the output
            // return [$query,$bindsSet];
            return $this->db->resultSet();
        }
        // perform computeCurrentStatusCounts
        if (sortAction == "computeCurrentStatusCounts") {
            $whereClause = " WHERE";
            $bindsSet = array();
            $unworkableFieldValues = array("undefined", null, "", "All", "null");
            $unworkableFieldNames = array("location", "property");
            // filter the sort arguments
            foreach ($arguments as $key => $value) {
                $data = explode(',', $value);
                $fieldName = $data[0];
                $fieldValue = $data[1];
                if (!in_array($fieldName, $unworkableFieldNames)) {
                    if (!in_array($fieldValue, $unworkableFieldValues)) {
                        $whereClause .= " " . $fieldName . " = :" . $fieldName . " AND";
                        $bindsSet[$fieldName] = $fieldValue;
                    }
                }
            }
            // removes trailing AND
            $whereClause = chop($whereClause, " AND ");
            // removes trailing where in case
            $whereClause = chop($whereClause, " WHERE");

            $query = "SELECT status,count(status) as count FROM (
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
            ) AS intoreData $whereClause GROUP BY status";
            // prepares the query
            $this->db->query($query);
            // bind the values to the query
            foreach ($bindsSet as $name => $value) {
                $this->db->bind(':' . $name, $value);
            }
            return $this->db->resultSet();
        }
    }
}
