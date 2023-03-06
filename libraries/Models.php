<?php
class Models // ESTA CLASE ESTA SIENDO LLAMADA EN EL ARCHIVO INDEX.PHP
{
    public $modelsData = null;

    public function __construct()
    {
        $this->modelsData = new Conexion();
    }
}
