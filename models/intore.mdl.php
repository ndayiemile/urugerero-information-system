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
        $tuples = ["*"];
        return $this->db->selectAnd("intoreIdentities", $tuples, $arguments);
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
            $currentStatusSortKeys = ["all", "active", "employed", "sick", "studying"];

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
            $unworkableFieldValues = array("undefined", null, "", "all", "null");
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
            $query = "SELECT * FROM intoreIdentities" . $whereClause . " ORDER BY id ASC LIMIT " . $entries;
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
            $havingClause = " HAVING";
            $bindsSet = array();
            $unworkableFieldValues = array("undefined", null, "", "all", "null");
            $unworkableFieldNames = array("location", "property");
            // filter the sort arguments
            foreach ($arguments as $key => $value) {
                $data = explode(',', $value);
                $fieldName = $data[0];
                $fieldValue = $data[1];
                if (!in_array($fieldName, $unworkableFieldNames)) {
                    if (!in_array($fieldValue, $unworkableFieldValues)) {
                        $havingClause .= " " . $fieldName . " = :" . $fieldName . " AND";
                        $bindsSet[$fieldName] = $fieldValue;
                    }
                }
            }
            // removes trailing AND
            $havingClause = chop($havingClause, " AND ");
            // removes trailing where in case
            $havingClause = chop($havingClause, " HAVING");

            $query = "SELECT *,count(currentStatus) as currentStatusCount FROM `intoreIdentities` GROUP BY currentStatus" . $havingClause;
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
