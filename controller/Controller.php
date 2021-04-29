<?php

$data = NULL;

class Controller {

	public function __construct() {

	}

	public function render($view, $d=null) {
		global $data, $model, $onglet;

		$controller = get_class($this);  // SiteController
		$model = substr($controller, 0, 
		strpos($controller, "Controller")); // Site

		$data = $d;

		include_once "view/header.php";
		if (isset($_SESSION['user']))
			include_once "components/loggedHeader.php";
		include_once "view/".strtolower($model)."/".$view.".php";
		include_once "view/footer.php";
	}

	public function renderComponent($component, $d=null) {
		global $data, $model, $onglet;

		$controller = get_class($this);  // SiteController
		$model = substr($controller, 0, 
		strpos($controller, "Controller")); // Site

		$data = $d;

		include_once "view/header.php";
		if (isset($_SESSION['user']))
			include_once "components/loggedHeader.php";
		include_once "components"."/".$component.".php";
		include_once "view/footer.php";
	}
}