<?php
class Reports
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function registerNewIntore(...$arguments)
    {
        return $this->db->insert("intoreIdentities", ...$arguments);;
    }
    public function saveNewActivity(...$arguments)
    {
        return $this->db->insert("activities", ...$arguments);
    }

    public function savePermission(...$arguments)
    {
        return $this->db->insert("permissions", ...$arguments);
    }
    public function saveHonor(...$arguments)
    {
        return $this->db->insert("honors", ...$arguments);
    }
    public function saveMisconduct(...$arguments)
    {
        return $this->db->insert("misconducts", ...$arguments);
    }
    public function saveResponsibility(...$arguments)
    {
        return $this->db->insert("responsibilities", ...$arguments);
    }
}
