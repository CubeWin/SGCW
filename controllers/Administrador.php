<?php

class Administrador extends Controllers
{

    public function __construct()
    {
        parent::__construct();
    }

    public function persona()
    {
        $this->view->renderHeadAdmin($this, "persona");
    }

    public function usuario()
    {
        $this->view->renderHeadAdmin($this, "usuario");
    }

    public function seccion($id = [])
    {
        if ($id != null) {
            $this->view->request($id);
            $this->view->renderHeadAdmin($this, "seccion");
        } else {
            echo "Error";
        }
    }
}
