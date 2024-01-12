<?php
class Login
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function userLogin(...$arguments)
    {
        $arguments['password'] = md5(
            $arguments['password']
        );
        $tuples = ["id"];
        try {
            $result = $this->db->selectAnd("users", $tuples, $arguments);
            if (count($result) == 1) {
                $userId = (int)$result[0]->id;
                $name = "userId";
                $value = $userId;
                $validityDuration = time() + COOKIE_VALIDITY_TIME; //86400sec = 1 day
                $path = "/";
                setcookie($name,$value,$validityDuration,$path);
                return [true, ["message" => "well logged in"]];
            } else {
                return [false, ["message" => $result]];
            }
        } catch (Throwable $e) {
            array_push($GLOBALS['debugger'], ["message" => $e->getMessage(), "Throwable" => $e]);
        }
    }
}
