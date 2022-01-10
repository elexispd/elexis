<?php 

spl_autoload_register('autoload');

function autoload($className){
	$url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
	if (strpos($url, "includes")) {
		$path = "../classes/";
	} elseif (strpos($url, "classes")) {
		$path = "/classes/";
	}
	 else {
		$path = "php/classes/";
	}

	$extension = ".class.php";
	$full = $path.$className.$extension;

	require_once $full;
	
}