<?php

$data = NULL;

class Controller {

	public function __construct() {

	}

	public function render($view, $d=null) {
		global $data;
		include_once "view/header.php";

		$controller = get_class($this);  // SiteController
		$model = substr($controller, 0, 
			        strpos($controller, "Controller")); // Site
		$data = $d;
		include_once "view/".strtolower($model)."/".$view.".php";
		// view/site/index.php

		include_once "view/footer.php";
	}

}

