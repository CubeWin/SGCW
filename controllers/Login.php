<?php
class Login extends Controllers
{

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->view->render($this, "login");
        setcookie('user', null, time() - 100, '/');
        setcookie('token', null, time() - 100, '/');
        setcookie('login', "log", time() + 600, '/');
    }

    public function inicio()
    {
        $this->view->renderHeadAdmin($this, "inicio");
    }
}
