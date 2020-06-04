<?php
class page extends Controllers
{
    function __construct()
    {
        parent::__construct();    
    }

    function inicio(){
        $this->view->renderHeadAdmin($this, "inicio");
    }

    function nosotros(){
        $this->view->renderHeadAdmin($this, "nosotros");
    }

    function servicios(){
        $this->view->renderHeadAdmin($this, "servicios");
    }
}
