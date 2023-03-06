<?php
require "./models/entities/Persona.Entity.php";


class Persona extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Headers: *");
        header("Content-Type: application/json");
    }

    public function listar()
    {
        $response     = $this->model->findAll();
        echo json_encode($response);
    }

    public function buscar($id)
    {
        $response = $this->model->findOne($id[0]);
        echo json_encode($response);
    }

    public function buscar_by_person($dato = [""])
    {
        $response = $this->model->findByPersona($dato[0]);
        echo json_encode($response);
    }

    public function guardar()
    {
        $formdata = json_decode(file_get_contents('php://input'), true);

        if (!empty($formdata)) {
            $persona = new PersonaEntity();

            $persona->setId(empty($formdata['id']) ? null : $formdata['id']);
            $persona->setName(empty($formdata['name']) ? null : $formdata['name']);
            $persona->setSurname(empty($formdata['surname']) ? null : $formdata['surname']);
            $persona->setTelephone(empty($formdata['telephone']) ? null : $formdata['telephone']);
            $persona->setEmail(empty($formdata['email']) ? null : $formdata['email']);
            $persona->setGender(empty($formdata['gender']) ? null : $formdata['gender']);
            $persona->setCreate_at(gmdate("Y-m-d H:i:s", time() + 3600 * (-6 + date("I"))));
            $persona->setUpdate_at(gmdate("Y-m-d H:i:s", time() + 3600 * (-6 + date("I"))));
            $persona->setDisable_at(gmdate("Y-m-d H:i:s", time() + 3600 * (-6 + date("I"))));
            $persona->setState(empty($formdata['state']) ? 1 : $formdata['state']);

            if ($persona->validate()) {
                //$response = $persona->toString();
                $response = $this->model->save($persona);
            } else {
                $array = ["fail" => "Datos inconpletos.", "tipo" => "danger"];
                $response =  (object) $array;
            }
            //$response = $persona->toString();
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
}
