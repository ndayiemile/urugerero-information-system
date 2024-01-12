<?php
$GLOBALS['debugger'] = [];
class App
{
    public $models;
    public $method;
    public $debugMode = true;
    public $errorsMessages = array();
    public $linksAndScripts;
    public $parameters = [];
    public function __construct()
    {
        // required set up classes
        require_once 'sessions.php';
        require_once 'config.php';
        require_once 'database.php';
        // ajax request handler
        if (isset($_REQUEST['ajaxRequestIdentifier'])) {
            $this->asyncHandler();
        }
        //  inline php page handler;
        else {
            $this->inlineHandler();
        }
    }

    private function asyncHandler()
    {
        if ($_REQUEST['serverTargetFunction'] != null) {
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
            include_once('../models/globalModel.mdl.php');
            include_once('../models/' . $pageName . '.mdl.php');
            $this->models["pageModel"] = new $pageName();
            $this->models["globalModel"] = new GlobalModel;
            // call the method
            try {
                $response = call_user_func_array([$this->models["pageModel"], $this->method], $this->parameters);
                if (!is_object($response) && !is_array($response)) {
                    array_push(
                        $GLOBALS['debugger'],
                        [
                            "errorType" => "databaseError",
                            "parametersPasses" => $this->parameters,
                            "debug" => "database output is not json compatible",
                            "trace" => "check the current modal output",
                        ]
                    );
                }
            } catch (Throwable $th) {
                array_push(
                    $GLOBALS['debugger'],
                    [
                        "errorType" => "serverError",
                        "errorMessage" => $th->getMessage(),
                        "model" => $pageName,
                        "parameters" => $this->parameters,
                        "debug" => "the modal or function does not exits",
                    ]
                );
            }
        }
        // handler in case no target function is set on client side
        else {
            array_push(
                $GLOBALS['debugger'],
                [
                    "errorType" => "clientError",
                    "errorMessage" => "The request does not contain the server target function",
                    "model" => $pageName,
                ]
            );
        }
        /*AJAX_OUTPUT*/
        if (count($GLOBALS['debugger']) != 0 && $this->debugMode) {
            $response = ["throwableOutPut" => $GLOBALS['debugger']];
        }
        $response = json_encode($response);
        echo $response;
    }

    private function inlineHandler()
    {
        require_once 'linksAndScripts.php';
        // get the pageName
        $uri = $_SERVER['REQUEST_URI'];
        $pageName =  explode('.', explode('?', end(explode('/', filter_var($uri, FILTER_SANITIZE_URL))))[0])[0];
        // check if userLoggedIn
        if (!isLoggedIn()) {
            header("location:login.php");
        }
        // models location
        include_once '../../models/' . $pageName . '.mdl.php';
        include_once('../../models/globalModel.mdl.php');
        // get the links and scripts
        try {
            $this->linksAndScripts = call_user_func_array([new LinksAndScripts($pageName), $pageName], $this->parameters);
        } catch (Throwable $e) {
            $this->linksAndScripts = call_user_func_array([new LinksAndScripts($pageName), "default"], $this->parameters);
            array_push($GLOBALS['debugger'], ["message" => $e->getMessage(), "Throwable" => $e]);
        }
        /*this code approach is replicated since you can basically 
        set an $REQUEST[ajaxRequestIdentifier,serverTargetFunction]
         manually to achieve same modal function*/
        // create the inline(view emendable model instance)
        $this->models["globalModel"] = new GlobalModel;
        try {
            // instantiate the model
            $this->models["pageModel"] = new $pageName;
            // instantiate the LinksAndScripts
        } catch (Throwable $e) {
            array_push($GLOBALS['debugger'], ["message" => $e->getMessage(), "Throwable" => $e]);
        }
    }
}
$app = new App();
