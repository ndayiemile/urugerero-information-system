<?php
$GLOBALS['errorMessages'] = [];
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
        require_once 'sessions.php';
        // ajax request handler
        if (isset($_REQUEST['ajaxRequestIdentifier'])) {
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
            }
            // handler in case no target function is set on client side
            else {
                $response = array(
                    "errorType" => "clientError",
                    "errorMessage" => "The request does not contain the server target function",
                    "model" => $pageName,
                );
            }
            $response = json_encode($response);
            echo $response;
        }
        //  inline php page handler;
        else {
            require_once 'linksAndScripts.php';
            // get the pageName
            $uri = $_SERVER['REQUEST_URI'];
            $pageName =  explode('.', explode('?', end(explode('/', filter_var($uri, FILTER_SANITIZE_URL))))[0])[0];
            // models location
            include_once '../../models/' . $pageName . '.mdl.php';
            // get the links and scripts
            try {
                $this->linksAndScripts = call_user_func_array([new LinksAndScripts($pageName), $pageName], $this->parameters);
            } catch (Throwable $e) {
                $this->linksAndScripts = call_user_func_array([new LinksAndScripts($pageName), "default"], $this->parameters);
                array_push($GLOBALS['errorMessages'], $e->getMessage());
            }
            /*this code approach is replicated since you can basically 
            set an $REQUEST[ajaxRequestIdentifier,serverTargetFunction]
             manually to achieve same modal function*/
            // create the inline(view emendable model instance)
            try {
                // instantiate the model
                $this->model = new $pageName;
                // instantiate the LinksAndScripts
            } catch (Throwable $e) {
                array_push($GLOBALS['errorMessages'], $e->getMessage());
            }
        }
    }
}
$app = new App();
