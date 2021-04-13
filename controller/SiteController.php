<?php

class SiteController extends Controller {
	public function index() {
		$this->render("index");
	}


	public function presentation() {
		$this->render("presentation");	
	}

	public function update_presentation(){
		
		if (isset($_SESSION['user']) && $_SESSION['user']['idrole'] == 3){
			file_put_contents("./view/site/presentation-container.php", parameters()["presentation"]);
		}
	}

}


