<?php
class Home
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getNumberOfActivitiesAndRegisteredIntore(...$arguments)
    {
        $tuples = ["COUNT(*) AS count"];
        return ["activities" => (int)$this->db->selectAnd("activities", $tuples, $arguments)[0]->count,"intore"=> (int)$this->db->selectAnd("intoreIdentities", $tuples, $arguments)[0]->count];
    }
    
}
