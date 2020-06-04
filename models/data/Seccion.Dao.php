<?php

require "./models/data/Seccion.IDao.php";

class SeccionDao extends Models implements SeccionIDao
{
    private $sql = "";
    private $query = null;
    private $count = 0;
    private $response = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function seccionFinById($id)
    {
        try {
            $this->sql = "SELECT DT.id, DT.contenido, D.grupo, D.id id_detalle_pk, D.id_detalle id_detalle, B.id id_bloque, B.nombre, B.iterable FROM detalle D RIGHT JOIN detalle_texto DT ON D.id = DT.id_detalle INNER JOIN bloque B ON D.id_bloque = B.id
            WHERE D.id_seccion = :id_seccion ORDER BY  B.iterable ASC, D.id_detalle, B.id, D.grupo";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id_seccion" => $id
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = $this->query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $this->response = (object) ["fail" => "No hay datos para mostrar", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }
}
