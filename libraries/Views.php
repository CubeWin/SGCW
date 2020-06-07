<?php
class Views
{
    public $param = array();
    public $url = "http://localhost/new/pg/";

    function __construct()
    {
        // echo "Views Active <br>";
    }

    function renderHeadFooter($controller, $view)
    {
        $controller = strtolower(get_class($controller));

        require VIEWS . DFT . "assets.css.php";
        require VIEWS . DFT . "header.php";
        require VIEWS . $controller . "/" . $view . ".php";
        require VIEWS . DFT . "footer.php";
        require VIEWS . DFT . "assets.js.php";
    }

    function renderHeadAdmin($controller, $view)
    {
        $controller = strtolower(get_class($controller));

        require VIEWS . DFT . "assets.css.php";
        require VIEWS . DFT . "admin.header.php";
        require VIEWS . $controller . "/" . $view . ".php";
        require VIEWS . DFT . "admin.footer.php";
        require VIEWS . $controller . "/modals/" . $view . ".php";
        require VIEWS . DFT . "assets.js.php";
    }

    function render($controller, $view)
    {
        $controller = strtolower(get_class($controller));
        require VIEWS . DFT . "assets.css.php";
        require VIEWS . $controller . "/" . $view . ".php";
        require VIEWS . DFT . "assets.js.php";
    }

    function request($a)
    {
        foreach ($a as $b) {
            $this->param[] = $b;
        }
    }
}
