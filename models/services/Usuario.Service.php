<?php
require "./models/data/Usuario.Dao.php";
require "./models/services/Usuario.IService.php";

class UsuarioService implements UsuarioIService
{
    
    public $usuarioDao = null;

    public function __construct()
    {
        $this->usuarioDao = new UsuarioDao();
    }

    public function findAll()
    {
        return $this->usuarioDao->usuarioFindAll();
    }

    public function findOne($id)
    {
        return $this->usuarioDao->usuarioFindOne($id);
    }

    public function save(UsuarioEntity $usuario)
    {
        return $this->usuarioDao->usuarioSave($usuario);
    }

    public function delete($id)
    {
        return $this->usuarioDao->usuarioDelete($id);
    }

    public function validate(UsuarioEntity $usuario)
    {
        return $this->usuarioDao->usuarioLogin($usuario);
    }


}