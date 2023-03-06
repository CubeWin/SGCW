<?php
require "./models/data/Token.Dao.php";
class TokenService{
        
    public $tokenDao = null;

    public function __construct()
    {
        $this->tokenDao = new TokenDao();
    }
    public function validToken(){
        return $this->tokenDao->validToken();
    }
}