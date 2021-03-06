<?php

spl_autoload_register(function($name) {

	$dir = "model";
	if (strpos($name,"Controller") !== FALSE)
		$dir = "controller";

	$path = $dir."/".strtolower($name).".php";

	if(file_exists($path)){
		include_once $path;
	}else{
		(new SiteController())->render("index");
	}
});

function get_role(){
	if(isset($_SESSION["user"])){
		return $_SESSION["user"]["idrole"];
	}
	return -999;
}

function parametersExist($parameters) {
	$tmp = array_filter(parameters(), function($var){return $var != null;} );
	$intersect = array_intersect($parameters, array_keys($tmp));
	return count($intersect) == count($parameters);
}

function get_id(){
	if(isset($_SESSION["user"]["idinternaluser"])){
		return $_SESSION["user"]["idinternaluser"];
	}
}

function is_student(){
	return get_role() == 1;
}

function is_teacher(){
	return get_role() == 2;
}

function is_admin(){
	return get_role() == 3;
}
function is_visitor(){
	return get_role() == -999;
}

function go_back(){
	if (isset($_SERVER['HTTP_REFERER'])) 
		return header('Location: ' . $_SERVER['HTTP_REFERER']);

	return header('Location: .');
}

function id_or_back($data){
	if(!isset($data['id'])){
		go_back();
	}
}