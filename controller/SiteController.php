<?php

class SiteController extends Controller {
	public function index() {
		
		if (isset($_SESSION['user'])){
			if ($_SESSION['user']['idrole'] == 1) {
				$this->render("student/index");
			}
			if ($_SESSION['user']['idrole'] == 2) {
				$this->render("teacher/index");
			}
			if ($_SESSION['user']['idrole'] == 3) {
				$this->render("admin/index");
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
		
		if (isset($_SESSION['user']) && $_SESSION['user']['idrole'] == 3){
			file_put_contents("./view/site/presentation-container.php", parameters()["presentation"]);
		}
	}

	public function resultats(){

		if ($_SESSION['user']['idrole'] == 1) {
			$this->render("resultats");
		}
		else {if ($_SESSION['user']['idrole'] == 1) {
			$this->index();
		}}

	}

	public function prestation(){

		if ($_SESSION['user']['idrole'] == 1) {
			$this->render("prestation");
		}else {
			$this->index();
		}

	}

	public function contact(){

		if ($_SESSION['user']['idrole'] == 1) {
			$this->render("contact");
		}else {
			$this->index();
		}

	}



}


