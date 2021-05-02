<?php

class UsersController extends Controller {

	var $rolepermissions = [3];

	public function index() {
		$users =Internaluser::findOne(["deleted" => 0]);
		$this->render("index", $users);
	}

	public function add() {
		$message = null;
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
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (parametersExist(["Username", "Nom", "Prenom","Email","Role"])) {

				$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
				for ($i = 0; $i < 8; $i++) {
					$n = rand(0, strlen($alphabet)-1);
					$pass[$i] = $alphabet[$n];
				}
				$pass = implode("",$pass);

				$user = new InternalUser();
				$user->username = parameters()["Username"];
				$user->nom = parameters()["Nom"];
				$user->prenom = parameters()["Prenom"];
				$user->idrole = parameters()["Role"];
				$user->email = parameters()['Email'];
				$user->password = $pass;
				$message = ["type"=>"info", "content"=>"Le mots de passe aléatoire de $user->nom $user->prenom est $pass"];
				$user->insert();
			} else {
				$message = ["type"=>"error", "content"=>"Erreur lors de l'insertion"];
			}
			
		}
		$this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content, "message"=>$message]);

		
	}

	public function delete(){
        $user = new InternalUser(parameters()["id"]);

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $user->deleted = 1;
			$user->insert();
			header('Location: .?r=users');
        } else {
			$this->render("validate", $user);
		}

    }
}


