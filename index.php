<?php
require_once "configs/config.php";

spl_autoload_register(function ($class) {
	if (file_exists(LBS . $class . ".php")) {
		require LBS . $class . ".php";
	}
});
$app = new App();
