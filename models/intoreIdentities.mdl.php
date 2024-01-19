<?php
class IntoreIdentities
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getIntoreIdentities(...$arguments){
        $tuples = ["*"];
        return $this->db->selectAnd("intoreIdentities",$tuples,$arguments);
    }
    public function getIntoreStatus(...$arguments){
// Sick,Employed,Studying,Active,Inactive
    }
}
