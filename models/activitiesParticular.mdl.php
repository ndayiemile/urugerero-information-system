<?php
class ActivitiesParticular
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getActivityParticulars(...$arguments){
        $tuples = ["*"];
        return $this->db->selectAnd("activities",$tuples,$arguments);
    }
}
