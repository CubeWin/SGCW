<?php

interface UsuarioIService{
    
    public function findAll();

    public function save(UsuarioEntity $usuario);

    public function findOne($id);

    public function delete($id);

    public function validate(UsuarioEntity $usuario);
}