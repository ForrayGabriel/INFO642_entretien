<?php

$parameters = array();
if (isset($_POST))
	foreach($_POST as $k=>$v)
		$parameters[$k] = $v;
if (isset($_GET))
	foreach($_GET as $k=>$v)
		$parameters[$k] = $v;

function parameters() {
	global $parameters;
	return $parameters;
}


if (isset(parameters()["r"])) {
	
	$route = parameters()["r"];    

	if (strpos($route,"/") === FALSE)
		list($controller, $action) = array($route, "index");
	else
		list($controller, $action) = explode("/", $route);


	$controller = ucfirst($controller)."Controller"; 
	
	$c = new $controller();  
	$c->$action();	

} else {

	$c = new SiteController();
	$c->index();

}
