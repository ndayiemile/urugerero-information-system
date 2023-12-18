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
        // saves xlsx or csv file data to the database
        if (isset($_FILES["recordFile"]["tmp_name"][0])) {
            $filename = $_FILES["recordFile"]["tmp_name"][0];
            if ($_FILES["recordFile"]["size"][0] > 0) {
                //initial values to local variables
                $file = fopen($filename, "r");
                $fieldNames = array();
                $fieldValues = array();
                $caughtEmptyFields = array();
                $bindsSet = array();
                $topRowPointer = true;
                $firstColumnIsIdentifier = true;

                //fetch and sort data from the csv file
                while (($emapData = fgetcsv($file, 100000, ",")) !== FALSE) {
                    if ($topRowPointer) {
                        // select the header
                        for ($i = 0; $i < count($emapData); $i++) {
                            if ($emapData[$i] != "" && $emapData[$i] != null) {
                                array_push($fieldNames, $emapData[$i]);
                            }
                        }
                        //change the header pointer
                        $topRowPointer = false;
                        continue;
                    }
                    // insert normal data to the values array
                    array_push($fieldValues, $emapData);
                }
                //closes the file
                fclose($file);

                //creates insertFields query
                $fields = "";
                for ($i = 0; $i < count($fieldNames); $i++) {
                    if ($firstColumnIsIdentifier && $i == 0) {
                        continue;
                    }
                    $fields .= $fieldNames[$i] . ", ";
                }
                $fields = rtrim($fields, ", ");
                $insertFields = $table . "(" . $fields . ")";

                //get all cells, creates, insertValues string, and append name_values them to binds array
                $insertValues = "";
                for ($j = 0; $j < count($fieldValues); $j++) {
                    //checks whether the first column is for id
                    $firstColumnIsIdentifier = is_numeric(number_format($fieldValues[0][0]));
                    $valueNames = "";
                    //loops through the data rows and creates query parts
                    for ($i = 0; $i < count($fieldNames); $i++) {
                        //skips the first column, assuming it to be an identifier column
                        if ($firstColumnIsIdentifier && $i == 0) {
                            continue;
                        }
                        //initialize cell properties
                        $cellValue = $fieldValues[$j][$i];
                        $cellName = "R" . strval($j) . "C" . strval($i);
                        //throw message for empty cells
                        if (!($cellValue != "" && $cellValue != null)) {
                            array_push($caughtEmptyFields, ["position" => '$fieldValues[' . $j . '][' . $i . '] is empty or null', "fieldName" => $fieldNames[$i]]);
                        }
                        //create value name, adds to the query, and save to the binds array
                        $valueNames .= ":" . $cellName . ", ";
                        $bindsSet[$cellName] = $cellValue;
                    }
                    $valueNames = rtrim($valueNames, ", ");
                    $insertValues .= "(" . $valueNames . "), ";
                }
                $insertValues = rtrim($insertValues, ", ");

                // creates the database query
                $queryString = "INSERT INTO " . $insertFields . " VALUES " . $insertValues;
                // prepares the query
                $this->query($queryString);
                // bind the values to the query
                foreach ($bindsSet as $name => $value) {
                    $this->bind(':' . $name, $value);
                }
                try {
                    //executes the query
                    $this->execute();
                    return [true];
                } catch (Throwable $e) {
                    return ["dbQuery" => $queryString, "error" => $e->getMessage()];
                }
            }
        }
        // saves text input fields values from the form to the database
        else {
            $columns = "";
            $prepColumns = "";
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
            //bind the values to the query
            foreach ($arguments as $name => $value) {
                $this->bind(":" . $name, $value);
            }
            // run and debug query
            try {
                if ($this->execute()) {
                    return [true];
                }
            } catch (Throwable $e) {
                return ["dbQuery" => $queryString, "error" => $e->getMessage()];
            }
        }
    }

    // SELECT $tuples FROM $table WHERE (...arguments) = (...arguments)  // SELECT theme_picture_url,templates FROM teachers_settings WHERE tr_id = :tr_id AND student_id = :student_id
    public function selectAnd(string $table, array $tuples, array $arguments = [])
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
        $queryString = "SELECT " . $resultSetColumns . " FROM " . $table . " " . $whereClause . " ORDER BY id DESC";
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
            return ["dbQuery" => $queryString, "error" => $e->getMessage()];
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
