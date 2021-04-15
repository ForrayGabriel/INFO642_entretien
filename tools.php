<?php

spl_autoload_register(function($name) {

	$dir = "model";
	if (strpos($name,"Controller") !== FALSE)
		$dir = "controller";
	include_once $dir."/".strtolower($name).".php";
});

function get_role(){
	if(isset($_SESSION["user"])){
		return $_SESSION["user"]["idrole"];
	}
	return -999;
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
function as_arguments($arguments){
	foreach($arguments as &$argument){
		if(!isset(parameters()[$argument])){
			return false;
		}
	}
	return true;
	
}