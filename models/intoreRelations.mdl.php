<?php
class intoreRelations
{
   private $db;
   public function __construct()
   {
      $this->db = new Database;
   }
   public function getIntoreIdentities(...$arguments)
   {
      $tuples = ["id","fullName", "nationalId", "cell", "village"];
      return $this->db->selectAnd("intoreIdentities", $tuples, $arguments);
   }
   public function saveIntoreRelationForm(...$arguments)
    {
        return $this->db->insert("intoreRelations", ...$arguments);
    }
}
