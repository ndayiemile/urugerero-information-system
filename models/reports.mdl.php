<?php
class Reports
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function insertThenReturnId($table, $arguments)
    {
        if (!$this->db->selectAnd($table, ["id"], $arguments)) {
            $saveStatus = $this->db->insert($table, ...$arguments)[0];
            if ($saveStatus) {
                return [true,["entityName"=>$table,"entryId"=>(int)$this->db->selectAnd($table, ["id"], $arguments)[0]->id]];
            }
        } else {
            return [false, "message" => "the $table is already registered"];
        }
    }
    public function registerNewIntore(...$arguments)
    {
        $arguments["cohortId"] = $_SESSION['cohortId'];
        return $this->insertThenReturnId("intoreIdentities", $arguments);
    }
    public function saveNewActivity(...$arguments)
    {
        return $this->insertThenReturnId("activities", $arguments);
    }

    public function savePermission(...$arguments)
    {
        return $this->insertThenReturnId("permissions",$arguments);
    }
    public function saveHonor(...$arguments)
    {
        return $this->insertThenReturnId("honors",$arguments);
    }
    public function saveMisconduct(...$arguments)
    {
        return $this->insertThenReturnId("misconducts",$arguments);
    }
    public function saveResponsibility(...$arguments)
    {
        return $this->insertThenReturnId("responsibilities",$arguments);
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
