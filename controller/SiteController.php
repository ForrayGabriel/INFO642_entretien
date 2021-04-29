<?php

class SiteController extends Controller {
	public function index() {
		if (isset($_SESSION['user'])){
			if (is_student() || is_teacher()) {
				header('Location: ?r=prestation');
			}
			if (is_admin()) {
				header('Location: ?r=event');
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


