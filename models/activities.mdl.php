<?php
class activities
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getActivitiesParticulars(...$arguments)
    {
        $tuples = ["*"];
        return $this->db->selectAnd("activities", $tuples, $arguments);
    }
    public function sortActivities(...$arguments)
    {
        $whereClause = " WHERE";
        $entries = $arguments['numberOfEntries'];
        $bindsSet = array();
        $whereClauseExcludedParameters = ["numberOfEntries", "dueDateOperator"];
        if (!($arguments['participant'] == "undefined" && $arguments['dueDateOperator'] == "undefined" && $arguments['category'] == "undefined" && $arguments['dueDate'] = "")) {
            //prepare and append parameters
            foreach ($arguments as $name => $value) {
                if (!in_array($name, $whereClauseExcludedParameters)) {
                    $operator = "=";

                    //dueDate sort manager
                    if ($name == "dueDate") {
                        if ($arguments['dueDateOperator'] != "undefined") {
                            $operator = $arguments['dueDateOperator'];
                        } else {
                            continue;
                        }
                    }
                    //append the sort clause
                    if ($value != "undefined" && $value != "") {
                        $whereClause .= " " . $name . " " . $operator . " " . ":$name" . " AND";
                        $bindsSet[$name] = $value;
                    }
                }
            }
            // removes trailing AND
            $whereClause = chop($whereClause, " AND ");
        }
        // removes trailing where in case
        $whereClause = chop($whereClause, " WHERE ");
        //query
        $query = "SELECT * FROM activities" . $whereClause . " ORDER BY id DESC LIMIT $entries";
        $this->db->query($query);
        //bind the values to the query
        foreach ($bindsSet as $name => $value) {
            $this->db->bind(':' . $name, $value);
        }
        // return the result from database
        return $this->db->resultSet();
    }
}
