<?php

class UsersController extends Controller {

	var $rolepermissions = [3];

	public function index() {

		$users = Internaluser::findOne(["deleted" => 0]);

		$table_header = array("Username", "Nom", "Prenom", "Email", "Role");
    
		$table_content = array();
		foreach ($users as &$user) {
			$table_content[$user->idinternaluser] = array(
				"Username" => $user->username,
				"Nom" => $user->nom,
				"Prenom" => $user->prenom,
				"Email" => $user->email,
				"Role" => $user->idrole->name_role
			);
		}
	
		$table_addBtn = array("text" => "Ajouter un membre", "url" => "?r=users/add");
	
		$table_actions = array(
			array("url" => "?r=users/update&id=:id", "desc"=>"", "icon"=>"update.png"),
			array("url" => "?r=users/delete&id=:id", "desc"=>"delete member", "icon"=>"removeicon.png")
		);

		$this->renderComponent("table", ["header"=>$table_header, "content"=>$table_content, "addBtn"=>$table_addBtn, "actions"=>$table_actions]);
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
				$user->password = password_hash($pass,PASSWORD_DEFAULT);

				$user = new InternalUser();
				$user->username = parameters()["Username"];
				$user->nom = parameters()["Nom"];
				$user->prenom = parameters()["Prenom"];
				$user->idrole = parameters()["Role"];
				$user->email = parameters()['Email'];
				$user->password = $pass;
				$message = ["type"=>"info", "content"=>"Le mots de passe aléatoire de $user->username est $pass"];
				$user->insert();

				if (parameters()["Role"] == 1) {
					$user = InternalUser::findOne(["username" => $user->username, "nom" => $user->nom, "prenom" => $user->prenom, "email" => $user->email])[0];
		
					$student = new Student();
					$student->idinternaluser = $user->idinternaluser;
					$student->insert();
				}


			} else {
				$message = ["type"=>"Erreur", "content"=>"Champ manquants durant l'insertion de l'utilisateur"];
			}
			
		}
		$this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content, "message"=>$message]);

		
	}

	public function update() {
		id_or_back(parameters());
		$user = new InternalUser(parameters()["id"]);

		$message = null;
		$form_title = "Modifier un membre";
		$form_content = array(
			"Username"=>array("type"=>"text", "value"=>$user->username),
			"Nom"=>array("type"=>"text", "value"=>$user->nom),
			"Prenom"=>array("type"=>"text", "value"=>$user->prenom),
			"Email"=>array("type"=>"text", "value"=>$user->email),
			"Modifier le mot de passe"=>array("type"=>"checkbox", "options"=>["Régénérer le mot de passe"=>1])
			);
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (parametersExist(["Username", "Nom", "Prenom","Email"])) {
				$user->username = parameters()["Username"];
				$user->nom = parameters()["Nom"];
				$user->prenom = parameters()["Prenom"];
				$user->email = parameters()['Email'];
				if (isset(parameters()["Modifier_le_mot_de_passe"]) && parameters()["Modifier_le_mot_de_passe"] == 1) {
					$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
					for ($i = 0; $i < 8; $i++) {
						$n = rand(0, strlen($alphabet)-1);
						$pass[$i] = $alphabet[$n];
					}
					$pass = implode("",$pass);
					$user->password = password_hash($pass,PASSWORD_DEFAULT);
					$user->insert();
					$message = ["type"=>"Information", "content"=>"Le nouveau mot de passe de $user->username est $pass"];
				} else {
					return header('Location: .?r=users');
				}
			} else {
				$message = ["type"=>"Erreur", "content"=>"Champ manquants durant l'insertion de l'utilisateur"];
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


