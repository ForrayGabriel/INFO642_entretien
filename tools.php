<?php

spl_autoload_register(function($name) {

	$dir = "model";
	if (strpos($name,"Controller") !== FALSE)
		$dir = "controller";
	include_once $dir."/".strtolower($name).".php";
});
