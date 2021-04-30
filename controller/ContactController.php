<?php

class ContactController extends Controller {

	var $rolepermissions = [1,2,3];

	public function index() {
		if (isset($_SESSION['user'])){
			if ($_SESSION['user']['idrole'] == 3) {
				$contacts = UserContact::findAll();
			}else{
				$contacts = UserContact::findOne(["iduser_requestor" => $_SESSION['user']['idinternaluser'],"iduser_receiver" => $_SESSION['user']['idinternaluser']],"or");
			}
		}

		$this->render("index", $contacts);
	}

	public function view() {
		try {
			$contact = new UserContact(parameters()["id"]);
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
					"Contenu du message" => array("type" => "text-area")
				);
				$this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content]);
			}else{

				$user_list = array();

				foreach(InternalUser::findAll() as $user){
					$user_list[$user->nom . " " .  $user->prenom] = $user->idinternaluser;
				}

				$form_title = "Contacter un utilisateur";
				$form_content = array(
					"Utilisateur" => array("type" => "select", "options" => $user_list, "desc" => "Choisir un utilisateur"),
					"Titre du message"=>array("type" => "text"),
					"Contenu du message"=>array("type" => "text-area")

				);
				$this->renderComponent("form", ["title" => $form_title, "content" => $form_content]);
			}
		}else{
			if(isset($_POST['Titre_du_message']) && isset($_POST['Contenu_du_message'])){

				$usercontact = new UserContact();

				if(is_student() || is_visitor()){
					foreach(InternalUser::findOne(['idrole' => 3]) as $admin){
						$id_receiver = $admin->idinternaluser;
					}
					$usercontact->idinternaluser_receiver = $id_receiver;
				}else{
					if(isset($_POST['Utilisateur'])){
						$usercontact->idinternaluser_receiver = $_POST['Utilisateur'];
					}
				}

				$usercontact->idinternaluser_requestor = get_id();

				$usercontact->title_contact = $_POST['Titre_du_message'];
				$usercontact->description_contact = $_POST['Contenu_du_message'];
				$usercontact->date_contact = date("Y-m-d H:i:s");


				// Dorian : need to be update
				$usercontact->type_demande = "basic";
				$usercontact->have_response = 1;
				$usercontact->is_close = 1;

				$usercontact->insert();

				go_back();
			}
		}
	}
}

