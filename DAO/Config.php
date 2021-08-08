<?php

//Autoload de classes.
spl_autoload_register(function($className) {

	$fileName = "classes" . DIRECTORY_SEPARATOR . $className . ".php";

	if (file_exists($fileName)) {

		require_once ($fileName);
	}

});