<?php

class UsersController extends Controller {

	var $rolepermissions = [3];

	public function index() {
		$users = Internaluser::findAll();
		$this->render("index", $users);
	}

	public function add() {

		if($_SERVER['REQUEST_METHOD'] == "GET") {
            $form_title = "Ajouter un membre";
			$form_content = array(
				"Username"=>array("type"=>"text"),
				"Nom"=>array("type"=>"text"),
				"Prenom"=>array("type"=>"text"),
				"Email"=>array("type"=>"text"),
				"Role"=>array("type"=>"radio", "options"=>array(
					"Etudiant"=>1,
					"Professeur"=>2,
					"Admin"=>3))
				);
			$this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content]);
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
			var_dump(parameters());
		}

		
	}

	public function delete(){
        $user = new InternalUser(parameters()["id"]);

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $user->delete();
			// header('Location: .?r=users');
        } else {
			$this->render("validate", $user);
		}

    }
}


