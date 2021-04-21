<?php

class SiteController extends Controller {
	public function index() {
		if (isset($_SESSION['user'])){
			if (get_role() == 1) {
				$this->render("student");
			}
			if (get_role() == 2) {
				$this->render("teacher");
			}
			if (get_role() == 3) {
				$this->render("admin");
			}
		}
		else {
			$this->render("index");
		}
	}

	public function presentation() {
		$this->render("index");	
	}

	public function update_presentation(){
		
		if (isset($_SESSION['user']) && get_role() == 3){
			file_put_contents("./view/site/presentation-container.php", parameters()["presentation"]);
		}
	}
}


