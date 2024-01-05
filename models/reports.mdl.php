<?php
class Reports
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function extractFileToDb($returnEntryId = false, $table, $additionalDataForEachRow = [], $firstColumnIsIdentifier = true)
    {
        $filename = $_FILES["recordFile"]["tmp_name"][0];
        if ($_FILES["recordFile"]["size"][0] > 0) {
            //initial values to local variables
            $file = fopen($filename, "r");
            $fieldNames = array();
            $fieldValues = array();
            $caughtEmptyFields = array();
            $bindsSet = array();
            $topRowPointer = true;
            //fetch and sort data from the csv file
            while (($emapData = fgetcsv($file, 100000, ",")) !== FALSE) {
                if ($topRowPointer) {
                    // select the header
                    for ($i = 0; $i < count($emapData); $i++) {
                        if ($emapData[$i] != "" && $emapData[$i] != null) {
                            array_push($fieldNames, $emapData[$i]);
                        }
                    }
                    //add additionalDataForEachRow headers
                    foreach ($additionalDataForEachRow as $name => $value) {
                        array_push($fieldNames, $name);
                    }
                    //change the header pointer
                    $topRowPointer = false;
                    continue;
                }
                //add additionalDataForEachRow values
                foreach ($additionalDataForEachRow as $name => $value) {
                    array_push($emapData, $value);
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
                //append the cohort identifier
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
                        $iPosition = $i + 1;
                        $jPosition = $j + 1;
                        array_push($caughtEmptyFields, ["position" => '$fieldValues[' . $jPosition . '][' . $iPosition . '] is empty or null', "fieldName" => $fieldNames[$i]]);
                    }
                    //create value name, adds to the query, and save to the binds array
                    $valueNames .= ":" . $cellName . ", ";
                    $bindsSet[$cellName] = $cellValue;
                }
                $valueNames = rtrim($valueNames, ", ");
                $insertValues .= "(" . $valueNames . "), ";
            }
            $insertValues = rtrim($insertValues, ", ");

            if (!$returnEntryId) {
                // creates the database query
                $queryString = "INSERT INTO " . $insertFields . " VALUES " . $insertValues;
                // prepares the query
                $this->db->query($queryString);
                // bind the values to the query
                foreach ($bindsSet as $name => $value) {
                    $this->db->bind(':' . $name, $value);
                }
                $fileInfo = ["caughtEmptyFields" => $caughtEmptyFields];
                try {
                    //executes the query
                    $this->db->execute();
                    return [true, ["message" => "file extracted successfuly", "fileInfo" => $fileInfo]];
                } catch (Throwable $e) {
                    $fileInfo['file'] = $_FILES["recordFile"];
                    array_push($GLOBALS['debugger'], ["message" => $e->getMessage(), "Throwable" => $e, "dbQuery" => $queryString, "fileInfo" => $fileInfo]);
                }
            } else {
                //works if and only if the csv comprises of a header and one row.
                return $this->insertThenReturnId($table, $bindsSet);
            }
        }
    }
    public function insertThenReturnId($table, $arguments)
    {
        if (!$this->db->selectAnd($table, ["id"], $arguments)) {
            $saveStatus = $this->db->insert($table, ...$arguments)[0];
            if ($saveStatus) {
                return [true, ["entityName" => $table, "entryId" => (int)$this->db->selectAnd($table, ["id"], $arguments)[0]->id]];
            }
        } else {
            return [false, "message" => "the $table is already registered"];
        }
    }
    public function registerNewIntore(...$arguments)
    { // saves csv new intore csv file data to the database
        $table = "intoreIdentities";
        if (isset($_FILES["recordFile"]["tmp_name"][0])) {
            $additionalDataForEachRow = ["cohortId" => $_SESSION['cohortId']];
            return $this->extractFileToDb(false, $table, $additionalDataForEachRow);
        } else {
            return $this->insertThenReturnId($table, $arguments);
        }
    }
    public function saveNewActivity(...$arguments)
    {
        $table = "activities";
        if (isset($_FILES["recordFile"]["tmp_name"][0])) {
            return $this->extractFileToDb(true, $table, $arguments);
        } else {
            return $this->insertThenReturnId($table, $arguments);
        }
    }

    public function savePermission(...$arguments)
    {
        $table = "permissions";
        if (isset($_FILES["recordFile"]["tmp_name"][0])) {
            return $this->extractFileToDb(true, $table, $arguments);
        } else {
            return $this->insertThenReturnId($table, $arguments);
        }
    }
    public function saveHonor(...$arguments)
    {
        $table = "honors";
        if (isset($_FILES["recordFile"]["tmp_name"][0])) {
            return $this->extractFileToDb(true, $table, $arguments);
        } else {
            return $this->insertThenReturnId($table, $arguments);
        }
    }
    public function saveMisconduct(...$arguments)
    {
        $table = "misconducts";
        if (isset($_FILES["recordFile"]["tmp_name"][0])) {
            return $this->extractFileToDb(true, $table, $arguments);
        } else {
            return $this->insertThenReturnId($table, $arguments);
        }
    }
    public function saveResponsibility(...$arguments)
    {
        $table = "responsibilities";
        if (isset($_FILES["recordFile"]["tmp_name"][0])) {
            return $this->extractFileToDb(true, $table, $arguments);
        } else {
            return $this->insertThenReturnId($table, $arguments);
        }
    }


    public function uploadsUtilities()
    {
        //file operation parse
        // if (isset($_REQUEST['requestHaveFiles'])) {
        //     //NB: fileListName should be the same as the input fieldName and the destination table field
        //     $fileListNames = $_REQUEST['fileListNames'];
        //     //fileList upload errors
        //     $fileUploadResponse = array();
        //     //loops around all fileLists<=>inputFields names and their data
        //     for ($j = 0; $j < count($fileListNames); $j++) {
        //         //operations on each fileList
        //         $fileListName = $fileListNames[$i];
        //         $fileList = $_FILES[$fileListName];
        //         $dbFileNamesValue = array();
        //         $allowedExt = array("jpg", "png", "jiff", "jpeg");
        //         $uploadPath = "../depository/activities/";
        //         $uploadStateMessages = array();
        //         try {
        //             for ($i = 0; $i < count($fileList['name']); $i++) {
        //                 //Get Name | Size | Temp Location		    
        //                 $fileName =  $fileList['name'][$i];
        //                 $fileSize =  $fileList['size'][$i];
        //                 $fileTempName =  $fileList['tmp_name'][$i];
        //                 //Get File Ext   
        //                 $fileType = explode('/',  $fileList['type'][$i]);
        //                 $fileExt = $fileType[1]; //file type	
        //                 // check extension
        //                 if (in_array($fileExt, $allowedExt)) {
        //                     // checks fle size
        //                     if ($fileSize <= 10000000) {
        //                         $newfileName = uniqid('', true) . '.' . $fileExt;
        //                         $newLocation = $uploadPath . $newfileName;
        //                         if (move_uploaded_file($fileTempName, $newLocation)) {
        //                             $message = $fileName . " =>file well uploaded";
        //                             array_push($uploadStateMessages, $message);
        //                             // register the file to the database
        //                             array_push($dbFileNamesValue, $fileName);
        //                         } else {
        //                             $message = $fileName . " =>server failed to upload the image";
        //                             array_push($uploadStateMessages, $message);
        //                         };
        //                     } else {
        //                         $message = $fileName . " =>is to large[$fileSize]";
        //                         array_push($uploadStateMessages, $message);
        //                     }
        //                 } else {
        //                     $message = $fileName . " =>Extension not allowed[$fileExt]";
        //                     array_push($uploadStateMessages, $message);
        //                 }
        //             }
        //             unset($_FILES);
        //         } catch (Throwable $th) {
        //             array_push($uploadStateMessages, $th);
        //         }
        //         //sets the new string to be save in the database
        //         $dbFileNamesValue = implode('<*%#>',  $dbFileNamesValue);
        //         //code for updating the database
        //         //......
        //         //this fileList response
        //         array_push($fileUploadResponse, $uploadStateMessages);
        //         // print_r($fileList);
        //     }
        //     // response to the client
        //     echo json_encode($fileUploadResponse);
        // }
    }
}
