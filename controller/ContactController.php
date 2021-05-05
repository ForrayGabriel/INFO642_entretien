<?php

class ContactController extends Controller {

	var $rolepermissions = [1,2,3];

	public function index() {
		if (isset($_SESSION['user'])){
			if ($_SESSION['user']['idrole'] == 3) {
				$contacts = UserContact::findAll(['ORDER BY' => ['date_contact' => 'DESC']]);
			}else{
				$contacts = UserContact::findOne(["idinternaluser_requestor" => $_SESSION['user']['idinternaluser'],"idinternaluser_receiver" => $_SESSION['user']['idinternaluser']],"or");
			}
		}

		$table_header = array("Object", "Envoyé par ?","Envoyé pour ?", "Erreur", "Date");
    
		$table_content = array();
		foreach ($contacts as &$contact) {
			$table_content[$contact->idusercontact] = array(
				"Object" => $contact->title_contact,
				"Qui" => $contact->idinternaluser_requestor->nom." ".$contact->idinternaluser_requestor->prenom,
				"Pour" => $contact->idinternaluser_receiver->nom." ".$contact->idinternaluser_receiver->prenom,
				"Erreur" => $contact->type_demande,
				"Date" => $contact->date_contact,
			);
		}
		
		$table_addBtn = array("text" => "Contacter quelqu'un", "url" => "?r=contact/write");

		$table_actions = array(
			array("url" => "?r=contact/view&id=:id", "desc"=>"", "icon"=>"evaluationicon.png"),
			array("url" => "?r=", "desc"=>"fermer la conversation", "icon"=>"removeicon.png"));

		$this->renderComponent("table", ["header"=>$table_header, "content"=>$table_content, "addBtn"=>$table_addBtn, "actions"=>$table_actions]);
	}

	public function view($id = null) {
		try {
			if($id == null){
				$id = parameters()["id"];
			}

			$contact = new UserContact($id);

			$this->render("view", array('contact' => $contact, 'response' => ResponseContact::findAll(), 'internaluser' => InternalUser::findAll()));
		} catch (Exception $e) {
			(new SiteController())->render("index");
		}
	}

	public function reply(){
		if (isset(parameters()['answer_iduser_requestor']) and isset(parameters()['answer_iduser_receiver']) and isset(parameters()['answer_idcontact']) and isset(parameters()['answer_title']) and isset(parameters()['answer_text'])){
			$responsecontact = new ResponseContact();
			$responsecontact->idusercontact = parameters()['answer_idcontact'];
			$responsecontact->idinternaluser_requestor = parameters()['answer_iduser_requestor'];
			$responsecontact->idinternaluser_receiver = parameters()['answer_iduser_receiver'];
			$responsecontact->title_response = parameters()['answer_title'];
			$responsecontact->text_response = parameters()['answer_text'];
			$responsecontact->date_response = date("Y-m-d H:i:s");
			$responsecontact->insert();
		}
		go_back();
	}

	public function write(){
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			if(is_student() || is_visitor()){
				$form_title = "Contacter un administrateur";
				$form_content = array(
					"Titre du message" => array("type" => "text"),
					"Contenu du message" => array("type" => "text-area", "placeholder" => "Entrer le contenu du message")
				);
				$this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content]);
			}else{

				$user_list = array();
				$group_list = array();

				foreach(InternalUser::findAll() as $user){
					$user_list[$user->nom . " " .  $user->prenom] = $user->idinternaluser;
				}

				foreach(PeopleGroup::findAll() as $group){
					$group_list[$group->title_peoplegroup] = $group->idpeoplegroup;
				}

				$form_title = "Contacter un utilisateur";
				$form_content = array(
					"Utilisateur" => array("type" => "select", "options" => $user_list, "desc" => "Choisir un utilisateur", "!required" => 1),
					"Groupe Utilisateur" => array("type" => "select", "options" => $group_list, "desc" => "Choisir un groupe d'utilisateur", "!required" => 1),
					"Titre du message"=>array("type" => "text"),
					"Contenu du message"=>array("type" => "text-area", "placeholder" => "Entrer le contenu du message")

				);
				$this->renderComponent("form", ["title" => $form_title, "content" => $form_content]);
			}
		}else{
			if(isset($_POST['Titre_du_message']) && isset($_POST['Contenu_du_message'])){

				$receivers = array();

				if(is_student() || is_visitor()){
					foreach(InternalUser::findOne(['idrole' => 3]) as $admin){
						array_push($receivers, $id_receiver);
					}
				}else{
					if(isset($_POST['Utilisateur'])){
						array_push($receivers,$_POST['Utilisateur']);
					}

					if(isset($_POST['Groupe_Utilisateur'])){
						$users = BelongGroup::findOne(['idpeoplegroup' => $_POST['Groupe_Utilisateur']]);
						foreach($users as $user){
							array_push($receivers,$user->idinternaluser->idinternaluser);
						}
					}
				}

				foreach($receivers as $receiver){
					$usercontact = new UserContact();
					$usercontact->idinternaluser_receiver = $receiver;
					$usercontact->idinternaluser_requestor = get_id();

					$usercontact->title_contact = $_POST['Titre_du_message'];
					$usercontact->description_contact = $_POST['Contenu_du_message'];
					$usercontact->date_contact = date("Y-m-d H:i:s");

					// Dorian : need to be update
					$usercontact->type_demande = "basic";
					$usercontact->have_response = 1;
					$usercontact->is_close = 1;
					$usercontact->insert();
				}
				
				return $this->index();
			}
		}
	}
}

