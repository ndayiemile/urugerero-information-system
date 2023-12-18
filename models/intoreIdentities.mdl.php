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
}
