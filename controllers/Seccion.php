<?php

class Seccion extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Headers: *");
        header("Content-Type: application/json");
    }

    public function listar($id = [])
    {
        if ($id != null) {
            $response     = $this->model->findById($id[0]);
        } else {
            $response = (object) ["fail" => "NO SE RECIBIO EL CODIGO", "tipo" => "danger"];
        }
        echo json_encode($response);
    }
}
