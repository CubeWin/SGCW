<?php

class Content extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Headers: *");
        header("Content-Type: application/json");
    }

    public function listar($final)
    {
        $response = $this->model->findAll($final[0]);
        echo json_encode($response);
    }

    public function actualizar($final)
    {
        /**
         * , $content, $id
         */
        $formdata = json_decode(file_get_contents('php://input'), true);
        if (!empty($formdata)) {

        } else {
            $array = ["fail" => "No se enviaron datos.", "tipo" => "danger"];
            $response =  (object) $array;
        }
        $response = "";
        echo json_encode($response);
    }

    public function deshabilitar($final)
    {
        $response = $this->model->disableOne($final[0]);
        echo json_encode($response);
    }

    public function vista($final)
    {
        $response = $this->model->preView($final[0]);
        echo json_encode($response);
    }

    public function buscar($final)
    {
        /**
         * , $id
         */
        $formdata = json_decode(file_get_contents('php://input'), true);
        if (!empty($formdata)) {

        } else {
            $array = ["fail" => "No se enviaron datos.", "tipo" => "danger"];
            $response =  (object) $array;
        }
        $response = "";
        echo json_encode($response);
    }

    public function crearBloque($final)
    {
        $response = $this->model->addBlock($final[0]);
        echo json_encode($response);
    }

    public function eliminarBloque($final)
    {
        /**
         * , $bloque
         */
        $formdata = json_decode(file_get_contents('php://input'), true);
        if (!empty($formdata)) {

        } else {
            $array = ["fail" => "No se enviaron datos.", "tipo" => "danger"];
            $response =  (object) $array;
        }
        $response = "";
        echo json_encode($response);
    }
}
