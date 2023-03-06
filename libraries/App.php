<?php
require "controllers/Error.php";

class App
{
	function __construct()
	{
		$url = $_GET["url"] ?? "Login";
		//$url = isset($_GET["url"])? $_GET["url"] : "Login/login";
		$url = rtrim($url, '/');
		$url = explode("/", $url);
		$controller = "";

		if (isset($url[0])) {
			$controller = $url[0];
			$controller = ucfirst($controller);
        }


		//print_r($url);
		$nparam = sizeof($url);
		$controllersPath = "controllers/$controller.php";

		if (file_exists($controllersPath)) {

			require $controllersPath;
			$controller = new $controller();

			if ($nparam > 1) { // Y SI HAY MAS DE LA POSICION [0] DEL ARRAY "http://dominio.com/url[0]/url[1]/url[2]...", $nparam = sizeof($url) 

				if (isset($url[1])) { // SI HAY VERIFICAMOS SI NO ES NULL
					$method = $url[1]; // ESTE SERA NUESTRO METODO
					if (method_exists($controller, $method)) { // VERIFICAMOS SI EXISTE EL METODO
						if ($nparam > 2) { // VERIFICAMOS SI HAY MAS

							$param = [];

							for ($i = 2; $i < $nparam; $i++) { // DESPUES DEL LA POSICION URL[1] SERAN PARAMETROS
								array_push($param, $url[$i]);
								// RESUMEN "http://dominio.com/CLASE(SE EJECUTA EL CONSTRUCTOR)/METODO(FUNCTION)/[PARAMETRO1/ PARAMETRO2 / ...]"
							}

							$controller->{$method}($param); // LE DAMOS AL METODO LOS PARAMETROS
						} else {
							$controller->{$method}(); // SOLO DAMOS EL METODO
						}

					} else {
						$error = new Errors();
						$error->error(); // SI NO EXISTE EL METODO SE MOSTRARA ERROR VISTA
					}
				}

			}else{
				$controller->render(); // SOLO HAY URL[0] MOSTRAMOS CONTENIDO VISTA
			}

		} else {
			$error = new Errors();
			$error->error(); // SI NO EXISTE LA CLASE SE MOSTRARA ERROR VISTA
		}
	}
}
// HASTA ESTE PUNTO ESTAMOS LLAMANDO A LOS CONTROLADORES DE LA CARPETA CONTROLLERS, CADA CONTROLADOR ES HIJO DEL CONTROLADOR DE ESTA CARPETA LIBRARIES. REVISAR ERROR