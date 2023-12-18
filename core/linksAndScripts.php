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
    public function __construct()
    {
        $this->globalHeadLinks = [
            '<!-- bootstrap styleSheets -->
            <link rel="stylesheet" href="../../libs/bootstrap-5.3.2-dist/css/bootstrap.min.css" />',
            '<!-- local globalStylesheet -->
            <link rel="stylesheet" href="../../libs/css/globalStyle.css" />',
        ];
        $this->globalHeadScripts = [
            '<!-- bootstrap scripts -->
            <script type="text/javascript" src="../../libs/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js" defer></script>',
            '<!-- utilities -->
            <script type="text/javascript" src="../../libs/js/utils.js" defer></script>',
            '<!-- local globalScript -->
            <script type="text/javascript" src="../../libs/js/globalScript.js" defer></script>',
        ];
    }
    // $linksAndScripts function prototype
    public function default(){
        $this->headLinks = [];
        $this->headScripts = [];
        $this->footLinks = [];
        $this->footScripts = [];
        return $this->returnAll();
    }
    private function returnAll(){
        // head Links and Scripts
        $this->headLinksAndScripts = array_merge($this->globalHeadLinks,$this->headLinks,$this->globalHeadScripts,$this->headScripts,);
        // foot links and styles
        $this->footLinksAndScripts = array_merge($this->globalFootLinks,$this->footLinks,$this->globalFootScripts,$this->footScripts,);
        return ["head"=>$this->headLinksAndScripts,"foot" =>$this->footLinksAndScripts];
    }
    public function home()
    {
        $this->headScripts = [
            '<!-- home-page script -->
            <script type="text/javascript" src="../../libs/js/indexScript.js" defer></script>',
        ];
        $this->footScripts = [
            '<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>',
        ];
        return $this->returnAll();
    }
    public function reports(){
        $this->headScripts = [
            '<!-- reports-page script -->
            <script type="text/javascript" src="../../libs/js/reportsScript.js" defer></script>',
        ];
        return $this->returnAll();    
    }
    public function intore()
    {
        $this->headLinks = [
            '<link rel="stylesheet" href="../../libs/css/intoreStyle.css" />',
        ];
        $this->headScripts = [
            '<!-- intore-page script -->
            <script type="text/javascript" src="../../libs/js/intoreScript.js" defer></script>',
        ];
        return $this->returnAll();    
    }
    public function intoreRegister(){
        $this->headScripts = [
            '<!-- intore-page script -->
            <script type="text/javascript" src="../../libs/js/intoreRegisterScript.js" defer></script>',
        ];
        return $this->returnAll(); 
    }
    public function intoreIdentities(){
        $this->headLinks = [
            '<link rel="stylesheet" href="../../libs/css/intoreIdentitiesStyle.css" />',
        ];
        $this->headScripts = [
            '<!-- intoreIdentities-page script -->
            <script type="text/javascript" src="../../libs/js/intoreIdentitiesScript.js" defer></script>',
        ];
        return $this->returnAll(); 
    }
    public function activities(){
        $this->headScripts = [
            '<!-- intore-page script -->
            <script type="text/javascript" src="../../libs/js/activitiesScript.js" defer></script>',
        ];
        return $this->returnAll(); 
    }
    public function ActivitiesParticular(){
        $this->headScripts = [
            '<!-- intore-page script -->
            <script type="text/javascript" src="../../libs/js/activitiesParticularScript.js" defer></script>',
        ];
        return $this->returnAll(); 
    }
}
