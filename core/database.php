<?php
class Database
{
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $dbname = DB_NAME;
    private $pwd = DB_PWD;
    private $user = DB_USER;
    private $stmt;
    private $dbh;
    private $error;
    public function __construct()
    {
        // SDN
        $sdn = "mysql:host=$this->host;port=$this->port;charset=utf8;dbname=$this->dbname";
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        );
        // create PDO instance
        try {
            $this->dbh = new PDO($sdn, $this->user, $this->pwd, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // prepare stmt
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // bind Values
    public function bind($parameter, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($parameter, $value, $type);
    }
    // execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }
    // Get result set as array of objects
    public function singleData()
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    // Get rows count in result set
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    /*frequently used function */
    //  insert operation function
    public function insert($table, ...$arguments)
    {
        $columns = "";
        $prepColumns = "";
        // $columns = "cohortId, ";
        // $prepColumns = ":cohortId, ";
        // create string parts from passed parameters
        foreach ($arguments as $name => $value) {
            $columns .= $name . ", ";
            $prepColumns .= ":" . $name . ", ";
        }
        // remove the trailing spaces and commas
        $columns = rtrim($columns, ", ");
        $prepColumns = rtrim($prepColumns, ", ");
        // creates the query
        $queryString = "INSERT INTO " . $table . "(" . $columns . ")" . " VALUES (" . "$prepColumns" . ")";
        $this->query($queryString);
        // append the cohort identifier
        // $this->bind(":cohortId", $_SESSION['cohortId']);
        // bind the values to the query
        foreach ($arguments as $name => $value) {
            $this->bind(":" . $name, $value);
        }
        // run and debug query
        try {
            return [$this->execute()];
        } catch (Throwable $e) {
            array_push($GLOBALS['debugger'], ["message" => $e->getMessage(), "Throwable" => $e, "dbQuery" => $queryString]);
        }
    }

    // SELECT $tuples FROM $table WHERE (...arguments) = (...arguments)  // SELECT theme_picture_url,templates FROM teachers_settings WHERE tr_id = :tr_id AND student_id = :student_id
    public function selectAnd(string $table, array $tuples, array $arguments = [],$orderBy = "id")
    {
        $whereClause = "WHERE ";
        $resultSetColumns = "";
        // columns to be returned preparation
        foreach ($tuples as $col) {
            $resultSetColumns .= $col . ",";
        }
        $resultSetColumns = rtrim($resultSetColumns, ",");
        // where clause preparation
        if (count($arguments) != 0) {
            foreach ($arguments as $arg => $value) {
                $whereClause .= $arg . " = :" . $arg . " AND ";
            }
            $whereClause = chop($whereClause, " AND ");
        } else {
            $whereClause = "";
        }
        // query preparation
        $queryString = "SELECT " . $resultSetColumns . " FROM " . $table . " " . $whereClause . " ORDER BY $orderBy DESC";
        $queryString = rtrim($queryString);
        //prepare the query
        $this->query($queryString);
        //bind the values to the query
        foreach ($arguments as $name => $value) {
            $this->bind(':' . $name, $value);
        }
        // run and debug query
        try {
            return $this->resultSet();
        } catch (Throwable $e) {
            array_push($GLOBALS['debugger'], ["message" => $e->getMessage(), "Throwable" => $e, "dbQuery" => $queryString]);
        }
    }


    // UPDATE $table SET $cell = $cell WHERE (...arguments) = (...arguments) // UPDATE teachers_settings SET theme_picture_url = :theme_picture_url WHERE tr_id = :tr_id
    // public function updateAnd($table,...$cell,...$arguments){
    //     $columns = "";
    //     $prepColumns = "";
    //     // create string parts from passed parameters
    //     foreach ($arguments as $name => $value) {
    //         $columns .= $name . ", ";
    //         $prepColumns .= ":" . $name . ", ";
    //     }
    //     // remove the trailing spaces and commas
    //     $columns = rtrim($columns, ", ");
    //     $prepColumns = rtrim($prepColumns, ", ");
    //     // creates the query
    //     $queryString = "INSERT INTO " . $table . "(" . $columns . ")" . " VALUES (" . "$prepColumns" . ")";
    //     $this->query($queryString);
    //     //bind the values to the query
    //     foreach ($arguments as $name => $value) {
    //         $field = ":" . $name;
    //         $this->bind($field, $value);
    //         $columns .= $name . ", ";
    //     }
    //    // run and debug query
    //     try{
    //         if($this->execute()){
    //             return [true];
    //         }
    //     }catch(Throwable $e){
    //         return ["dbQuery"=>$queryString,"error"=>$e->getMessage()];
    //     }
    // }

    // SELECT $tuples FROM $table WHERE $field IN (...arguments)
    // SELECT theme_picture_url,templates FROM teachers_settings WHERE tr_id = :tr_id AND student_id = :student_id
    // public function selectIn(...$tuples,$table,$field,...$arguments){
    //     $columns = "";
    //     $prepColumns = "";
    //     // create string parts from passed parameters
    //     foreach ($arguments as $name => $value) {
    //         $columns .= $name . ", ";
    //         $prepColumns .= ":" . $name . ", ";
    //     }
    //     // remove the trailing spaces and commas
    //     $columns = rtrim($columns, ", ");
    //     $prepColumns = rtrim($prepColumns, ", ");
    //     // creates the query
    //     $queryString = "INSERT INTO " . $table . "(" . $columns . ")" . " VALUES (" . "$prepColumns" . ")";
    //     $this->query($queryString);
    //     //bind the values to the query
    //     foreach ($arguments as $name => $value) {
    //         $field = ":" . $name;
    //         $this->bind($field, $value);
    //         $columns .= $name . ", ";
    //     }
    //    // run and debug query
    //     try{
    //         if($this->execute()){
    //             return [true];
    //         }
    //     }catch(Throwable $e){
    //         return ["dbQuery"=>$queryString,"error"=>$e->getMessage()];
    //     }
    // }

    // UPDATE $table SET $cell = $cell WHERE $field IN $arguments
    // UPDATE teachers_settings SET theme_picture_url = :theme_picture_url WHERE tr_id = :tr_id
    // public function updateIn($table,...$cell,$field,...$arguments){
    //     $columns = "";
    //     $prepColumns = "";
    //     // create string parts from passed parameters
    //     foreach ($arguments as $name => $value) {
    //         $columns .= $name . ", ";
    //         $prepColumns .= ":" . $name . ", ";
    //     }
    //     // remove the trailing spaces and commas
    //     $columns = rtrim($columns, ", ");
    //     $prepColumns = rtrim($prepColumns, ", ");
    //     // creates the query
    //     $queryString = "INSERT INTO " . $table . "(" . $columns . ")" . " VALUES (" . "$prepColumns" . ")";
    //     $this->query($queryString);
    //     //bind the values to the query
    //     foreach ($arguments as $name => $value) {
    //         $field = ":" . $name;
    //         $this->bind($field, $value);
    //         $columns .= $name . ", ";
    //     }
    //    // run and debug query
    //     try{
    //         if($this->execute()){
    //             return [true];
    //         }
    //     }catch(Throwable $e){
    //         return ["dbQuery"=>$queryString,"error"=>$e->getMessage()];
    //     }
    // }

    // public function deleteAnd($table, ...$arguments){
    //     $columns = "";
    //     $prepColumns = "";
    //     // create string parts from passed parameters
    //     foreach ($arguments as $name => $value) {
    //         $columns .= $name . ", ";
    //         $prepColumns .= ":" . $name . ", ";
    //     }
    //     // remove the trailing spaces and commas
    //     $columns = rtrim($columns, ", ");
    //     $prepColumns = rtrim($prepColumns, ", ");
    //     // creates the query
    //     $queryString = "INSERT INTO " . $table . "(" . $columns . ")" . " VALUES (" . "$prepColumns" . ")";
    //     $this->query($queryString);
    //     //bind the values to the query
    //     foreach ($arguments as $name => $value) {
    //         $field = ":" . $name;
    //         $this->bind($field, $value);
    //         $columns .= $name . ", ";
    //     }
    //    // run and debug query
    //     try{
    //         if($this->execute()){
    //             return [true];
    //         }
    //     }catch(Throwable $e){
    //         return ["dbQuery"=>$queryString,"error"=>$e->getMessage()];
    //     }
    // }

    // public function deleteIn($table, ...$arguments){
    //     $columns = "";
    //     $prepColumns = "";
    //     // create string parts from passed parameters
    //     foreach ($arguments as $name => $value) {
    //         $columns .= $name . ", ";
    //         $prepColumns .= ":" . $name . ", ";
    //     }
    //     // remove the trailing spaces and commas
    //     $columns = rtrim($columns, ", ");
    //     $prepColumns = rtrim($prepColumns, ", ");
    //     // creates the query
    //     $queryString = "INSERT INTO " . $table . "(" . $columns . ")" . " VALUES (" . "$prepColumns" . ")";
    //     $this->query($queryString);
    //     //bind the values to the query
    //     foreach ($arguments as $name => $value) {
    //         $field = ":" . $name;
    //         $this->bind($field, $value);
    //         $columns .= $name . ", ";
    //     }
    //    // run and debug query
    //     try{
    //         if($this->execute()){
    //             return [true];
    //         }
    //     }catch(Throwable $e){
    //         return ["dbQuery"=>$queryString,"error"=>$e->getMessage()];
    //     }
    // }
}
