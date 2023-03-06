<?php
interface UsuarioIDao
{
    public function usuarioFindAll();

    public function usuarioSave(UsuarioEntity $usuario);

    public function usuarioFindOne($id);

    public function usuarioDelete($id);

    public function usuarioLogin(UsuarioEntity $usuario);
}