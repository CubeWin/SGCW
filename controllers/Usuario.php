<?php
require "./models/entities/Usuario.Entity.php";

class Usuario extends Controllers
{
    public function __construct()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Headers: *");
        header("Content-Type: application/json");
        parent::__construct();
    }

    public function listar()
    {
        $response = $this->model->findAll();
        echo json_encode($response);
    }

    public function buscar($id)
    {
        $response = $this->model->findOne($id[0]);
        echo json_encode($response);
    }

    public function guardar()
    {

        $formdata = json_decode(file_get_contents('php://input'), true);

        if (!empty($formdata)) {
            $usuario = new UsuarioEntity();

            $opciones = ['cost' => 12];
			$clave = password_hash($formdata['password'], PASSWORD_BCRYPT, $opciones);

            $usuario->setId(empty($formdata['id']) ? null : $formdata['id']);
            $usuario->setId_persona(empty($formdata['id_persona']) ? null : $formdata['id_persona']);
            $usuario->setId_grupo(empty($formdata['id_grupo']) ? null : $formdata['id_grupo']);
            $usuario->setUser(empty($formdata['user']) ? null : $formdata['user']);
            $usuario->setPassword(empty($clave) ? null : $clave);
            $usuario->setCreate_at(gmdate("Y-m-d H:i:s", time() + 3600 * (-6 + date("I"))));
            $usuario->setUpdate_at(gmdate("Y-m-d H:i:s", time() + 3600 * (-6 + date("I"))));
            $usuario->setDisable_at(gmdate("Y-m-d H:i:s", time() + 3600 * (-6 + date("I"))));
            $usuario->setState(empty($formdata['state']) ? null : $formdata['state']);

            if($usuario->validate()){
                //$response = $usuario->toString();
                $response = $this->model->save($usuario);
            }else{
                $array = ["fail" => "Datos inconpletos.", "tipo" => "danger"];
                $response =  (object) $array;
            }
            //$response = $usuario->toString();
        } else {
            $array = ["fail" => "No se enviaron datos.", "tipo" => "danger"];
            $response =  (object) $array;
        }

        echo json_encode($response);
    }

    public function eliminar($id)
    {
        $response = $this->model->delete($id[0]);
        echo json_encode($response);
    }

    public function validar(){
        $formdata = json_decode(file_get_contents('php://input'), true);
        if(!empty($formdata)){
            $usuario = new UsuarioEntity();
            $usuario->setUser(empty($formdata['user']) ? null : $formdata['user']);
            $usuario->setPassword(empty($formdata['password']) ? null : $formdata['password']);
            $response = $this->model->validate($usuario);
        } else {
            $array = ["fail" => "No se enviaron datos.", "tipo" => "danger"];
            $response =  (object) $array;
        }

        echo json_encode($response);
    }
}