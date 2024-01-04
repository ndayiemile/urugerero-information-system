<?php
class LinksAndScripts
{
    private $headLinks = [];
    private $headScripts = [];
    private $footLinks = [];
    private $footScripts = [];
    private $globalHeadLinks = [];
    private $globalHeadScripts = [];
    private $globalFootLinks = [];
    private $globalFootScripts = [];
    private $headLinksAndScripts = [];
    private $footLinksAndScripts = [];
    private $linksAndScriptsBaseDirectory = "../../libs/";

    public function __construct($view)
    {
        $this->globalHeadLinks = [
            $this->css("bootstrap.min", true, "bootstrap-5.3.2-dist/css/"),
            $this->css("global"),
        ];
        $this->globalFootScripts = [
            $this->js("bootstrap.bundle.min", true, "bootstrap-5.3.2-dist/js/"),
            $this->js("utils"),
            $this->js("global")
        ];

        //get the view links and scripts using general access mechanism
        /*Follows that the view,script,style and model has the same file names*/
        $this->getViewDefaultLinksAndScripts($view);
    }

    private function css($styleFile, bool $locallyHosted = true, $directory = "css/")
    {
        $src = $this->linksAndScriptsBaseDirectory . $directory . $styleFile . '.css';
        if ($locallyHosted) {
            if (file_exists($src)) {
                return '<!-- ' . $styleFile . ' styleSheet -->
                <link rel="stylesheet" href="' . $src . '"/>';
            } else {
                array_push($GLOBALS['debugger'], "could not find $this->linksAndScriptsBaseDirectory$directory$styleFile.css");
            }
        } else {
            return '<!-- cloudSource styleSheet -->' . $styleFile;
        }
    }

    private function js($scriptFile, bool $locallyHosted = true, $directory = "js/")
    {
        $src = $this->linksAndScriptsBaseDirectory . $directory . $scriptFile . ".js";
        if ($locallyHosted) {
            if (file_exists($src)) {
                return '<!-- ' . $scriptFile . ' script --> 
                <script type="text/javascript" src="' . $src . '"></script>';
            } else {
                array_push($GLOBALS['debugger'], "could not find $this->linksAndScriptsBaseDirectory$directory$scriptFile.js");
            }
        } else {
            return '<!-- cloudSource script -->' . $scriptFile;
        }
    }

    private function getViewDefaultLinksAndScripts($view)
    {
        array_push($this->headLinks, $this->css("$view"));
        array_push($this->footScripts, $this->js("$view"));
    }

    public function default()
    {
        return $this->returnLinksAndScripts();
    }

    private function returnLinksAndScripts()
    {
        // head Links and Scripts
        $this->headLinksAndScripts = array_merge($this->globalHeadLinks, $this->headLinks, $this->globalHeadScripts, $this->headScripts,);
        // foot links and styles
        $this->footLinksAndScripts = array_merge($this->globalFootLinks, $this->footLinks, $this->globalFootScripts, $this->footScripts,);
        return ["head" => $this->headLinksAndScripts, "foot" => $this->footLinksAndScripts];
    }

    public function home()
    {
        array_push($this->headScripts, $this->js('<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>', false));
        return $this->returnLinksAndScripts();
    }
}
