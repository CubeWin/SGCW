<?php
class Controllers
{
	function __construct()
	{
		$url = constant("URL");

		//setcookie('contar', $_COOKIE["contar"] + 1, time() + 600, '/');

		if (isset($_COOKIE["token"])) {
			if ($this->validTokenController()) {
				$this->loadModel();
				$this->view = new Views();
				//setcookie('page1', "Existe COOKIE pero RETORNA TRUE", time() + 600, '/');
			} else {
				header("Location: " . $url);
				// setcookie('page2', "Existe COOKIE pero RETORNA FALSO", time() + 600, '/');
				setcookie('user', null, time() - 100, '/');
				setcookie('token', null, time() - 100, '/');
			}
		} else if ($this->getUrlCompare($url)) {
			$this->view = new Views();
			$this->loadModel();
			//setcookie('page3', "ES LA PAGINA DE LOGIN Y METODO", time() + 600, '/');
		} else {
			header("Location: " . $url);
			// setcookie('page4', "NO HAY TOKEN Y NO ES PAGINA DEL INICIO", time() + 600, '/');
		}
	}

	function loadModel()
	{
		$path = 'models/services/' . get_class($this)  . '.Service.php';

		if (file_exists($path)) {
			require $path;
			$modelName = get_class($this) . 'Service';
			$this->model = new $modelName();
		}
	}

	function validTokenController()
	{
		require "models/services/Token.Service.php";
		$token = new TokenService();
		return $token->validToken();
	}

	function getUrlCompare($url)
	{
		$respuesta = false;
		$dominio = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'];
		if ($url . "/" == $dominio || $url . "/usuario/validar" == $dominio) {
			$respuesta = true;
		}
		//echo "$url <> $dominio";
		return $respuesta;
	}


}
