<?php
class App
{
    public $model;
    public $method;
    public $debugMode = true;
    public $errorsMessages = array();
    public $linksAndScripts;
    public $parameters = [];
    public function __construct()
    {
        // ajax test
        // if (isset($_REQUEST['ajaxRequestIdentifier']) && ($_REQUEST['serverTargetFunction'] != null)) {
        //     echo json_encode($_REQUEST);
        //     unset($_REQUEST);
        // }
        // require the the set up classes
        require_once 'config.php';
        require_once 'database.php';
        // ajax request handler
        if (isset($_REQUEST['ajaxRequestIdentifier']) && ($_REQUEST['serverTargetFunction'] != null)) {
            unset($_REQUEST['ajaxRequestIdentifier']);
            // get the pageName, method and params from request
            $pageName = $_REQUEST['pageName'];
            unset($_REQUEST['pageName']);

            // get the server method to call
            $this->method = $_REQUEST['serverTargetFunction'];
            unset($_REQUEST['serverTargetFunction']);

            // gets the other parameters sent to server
            $this->parameters = $_REQUEST;

            // instantiate the model
            include_once('../models/' . $pageName . '.mdl.php');
            $this->model = new $pageName();

            // call the method
            try {
                $response = call_user_func_array([$this->model, $this->method], $this->parameters);
                if (!is_object($response) && !is_array($response)) {
                    $response = array(
                        "errorType" => "databaseError",
                        "parametersPasses" => $this->parameters,
                        "debug" => "database output is not json compatible",
                        "trace" => "check the current modal output",
                    );
                }
            } catch (Throwable $th) {
                $response = array(
                    "errorType" => "serverError",
                    "errorMessage" => $th->getMessage(),
                    "model" => $pageName,
                    "parameters" => $this->parameters,
                    "debug" => "the modal or function does not exits",
                );
            }
            $response = json_encode($response);
            echo $response;
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
        //  inline php page hundler;
        else {
            require_once 'linksAndScripts.php';
            // get the pageName
            $uri = $_SERVER['REQUEST_URI'];
            $pageName =  explode('.', explode('?', end(explode('/', filter_var($uri, FILTER_SANITIZE_URL))))[0])[0];
            // models location
            include_once '../../models/' . $pageName . '.mdl.php';
            // get the links and scripts
            try {
                $this->linksAndScripts = call_user_func_array([new LinksAndScripts(), $pageName], $this->parameters);
            } catch (Throwable $e) {
                $this->linksAndScripts = call_user_func_array([new LinksAndScripts(), "default"], $this->parameters);
                array_push($this->errorsMessages, $e->getMessage());
            }
            // get the model
            try {
                // instantiate the model
                $this->model = new $pageName;
                // instantiate the LinksAndScripts
            } catch (Throwable $e) {
                array_push($this->errorsMessages, $e->getMessage());
            }
        }
    }
}
$app = new App();
