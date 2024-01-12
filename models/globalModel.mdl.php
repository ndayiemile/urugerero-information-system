<?php
class GlobalModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getUserIdentities()
    {
        $tuples = ["firstName","secondName","email"];
        $arguments = ["id"=>$_COOKIE["userId"]];
        return $this->db->selectAnd("users", $tuples, $arguments)[0];
    }
}
?>