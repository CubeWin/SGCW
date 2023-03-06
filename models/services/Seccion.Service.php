<?php
require "./models/data/Seccion.Dao.php";
require "./models/services/Seccion.IService.php";

class SeccionService implements SeccionIService
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

    public function seccionAllByPage()
    {
        return $this->seccionDao->seccionPageAll();
    }

    public function seccionNameByPage($id)
    {
        return $this->seccionDao->seccionPageName($id);
    }

    public function disableSeccionById($id)
    {
        return $this->seccionDao->disableSeccion($id);
    }

    public function deleteDetalleById($id)
    {
        return $this->seccionDao->deleteDetalle($id);
    }

    public function updateDetalleTextoById($id, $contenido)
    {
        return $this->seccionDao->updateDetalleTexto($id, $contenido);
    }

    public function createDetalleTexto($seccion, $bloque, $id_detalle)
    {
        return $this->seccionDao->createDetalleTexto($seccion, $bloque, $id_detalle);
    }

    /** */
    public function readDetalleTextoById($id)
    {
        return $this->seccionDao->readDetalleTexto($id);
    }
}
