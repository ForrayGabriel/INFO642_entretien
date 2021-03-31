<?php

$data = NULL;

class Controller {

	public function __construct() {

	}

	public function render($view, $d=null) {
		global $data, $css;

		$controller = get_class($this);  // SiteController
		$model = substr($controller, 0, 
		strpos($controller, "Controller")); // Site

		$data = $d;
		$css = strtolower($model);

		include_once "view/header.php";
		include_once "view/".strtolower($model)."/".$view.".php";
		include_once "view/footer.php";
	}

}

