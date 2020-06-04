<?php
require "./models/data/Seccion.Dao.php";
require "./models/services/Seccion.IService.php";

class SeccionService  implements SeccionIService
{

    public $seccionDao = null;

    public function __construct()
    {
        $this->seccionDao = new SeccionDao();
    }

    public function findById($id)
    {
        return $this->seccionDao->seccionFinById($id);
    }
}
