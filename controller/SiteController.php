<?php

class SiteController extends Controller {
	public function index() {
		$this->render("index");
	}


	public function presentation() {
		$this->render("presentation");	
	}

	public function update_presentation(){
		print_r(parameters()["presentation"]);
		file_put_contents("./view/site/presentation-container.php", parameters()["presentation"]);
	}

}


