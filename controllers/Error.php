<?php
// CLASE QUE USAMOS PARA MOSTRAR UN PAGINA ERROR O NO ENCONTRADO 404
class Errors extends Controllers // ERRORS HEREDA DE CONTROLLERS, NO USAMOS REQUIRE YA QUE CONTROLLERS DE LA CARPETA LIBRARIES ESTA SIENDO LLAMADO EN EL ARCHIVO INDEX.PHP
{

	public function __construct()
	{ 
		//parent::__construct(); // EJECUTAMOS EL CONSTRUCTOR DEL PADRE
		$this->view = new Views();
	}

	public function error()
	{
		// echo "view Error";
		// EJECUTAMOS LA VARIABLE VIEW "$this->view = new Views();" QUE ESTA RELACIONADO CON LA VISTA Y SE EJECUTA EN EL PADRE
		$this->view->render($this, "error");
		// REVISAR EL PADRE EN LA CARPETA LIBRARIES/CONTROLLERS.PHP
	}
}
