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
            $response = $this->model->findById($id[0]);
        } else {
            $response = (object) ["fail" => "NO SE RECIBIO EL CODIGO", "tipo" => "danger"];
        }
        echo json_encode($response);
        }

    public function lateralMenu()
    {
        $response = $this->model->seccionAllByPage();
        echo json_encode($response);
    }

    public function tituloSeccion($id = [])
    {
        if ($id != null) {
            $response = $this->model->seccionNameByPage($id[0]);
        } else {
            $response = (object) ["fail" => "NO SE RECIBIO EL CODIGO", "tipo" => "danger"];
        }
        echo json_encode($response);
    }

    public function deshabilitarSeccion($id = [])
    {
        if ($id != null) {
            $response = $this->model->disableSeccionById($id[0]);
        } else {
            $response = (object) ["fail" => "NO SE RECIBIO EL CODIGO", "tipo" => "danger"];
        }
        echo json_encode($response);
    }

    public function eliminarDetalle($id = [])
    {
        if ($id != null) {
            $response = $this->model->deleteDetalleById($id[0]);
        } else {
            $response = (object) ["fail" => "NO SE RECIBIO EL CODIGO", "tipo" => "danger"];
        }
        echo json_encode($response);
    }

    public function actualizarDetalle()
    {
        $formdata = json_decode(file_get_contents('php://input'), true);
        $id = null;
        $contenido = null;
        if (!empty($formdata) && !empty($formdata['id'])) {
            $id = $formdata['id'];
            $contenido = $formdata['contenido'];
            $response = $this->model->updateDetalleTextoById($id, $contenido);
        } else {
            $array = ["fail" => "No se enviaron datos.", "tipo" => "danger"];
            $response =  (object) $array;
        }
        echo json_encode($response);
    }

    public function crearDetalleTexto()
    {
        $formdata = json_decode(file_get_contents('php://input'), true);
        $seccion = null;
        $bloque = null;
        $id_detalle = null;
        if (!empty($formdata) && !empty($formdata['seccion']) && !empty($formdata['bloque']) && !empty($formdata['id_detalle'])) {
            $seccion = $formdata['seccion'];
            $bloque = $formdata['bloque'];
            $id_detalle = $formdata['id_detalle'];
            $response = $this->model->createDetalleTexto($seccion, $bloque, $id_detalle);
        } else {
            $array = ["fail" => "No se enviaron datos.", "tipo" => "danger"];
            $response =  (object) $array;
        }
        echo json_encode($response);
    }

    public function leerDetalleTexto($id = [])
    {
        if ($id != null) {
            $response = $this->model->readDetalleTextoById($id[0]);
        } else {
            $response = (object) ["fail" => "NO SE RECIBIO EL CODIGO", "tipo" => "danger"];
        }
        echo json_encode($response);
    }
}
