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
		if (isset($_SESSION['user'])){
			if ($_SESSION['user']['idrole'] == 3) {
				include_once 'view/site/admin/header.php';
			}
			if ($_SESSION['user']['idrole'] == 2) {
				include_once 'view/site/teacher/header.php';
			}
			if ($_SESSION['user']['idrole'] == 1) {
				include_once 'view/site/student/header.php';
			}
		}
		include_once "view/".strtolower($model)."/".$view.".php";
		include_once "view/footer.php";
	}

}

