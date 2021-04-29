<?php

class ContactController extends Controller {

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

	public function send(){
		if (isset(parameters()['answer_iduser_requestor']) and isset(parameters()['answer_iduser_receiver']) and isset(parameters()['answer_idcontact']) and isset(parameters()['answer_title']) and isset(parameters()['answer_text'])){
			$responsecontact = new ResponseContact();
			$responsecontact->idusercontact = parameters()['answer_idcontact'];
			$responsecontact->iduser_requestor = parameters()['answer_iduser_requestor'];
			$responsecontact->iduser_receiver = parameters()['answer_iduser_receiver'];
			$responsecontact->title_response = parameters()['answer_title'];
			$responsecontact->text_response = parameters()['answer_text'];
			$responsecontact->date_response = date("Y-m-d H:i:s");
			$responsecontact->insert();
		}
		go_back();
	}
}

