<?php

class ContactController extends Controller {

	public function index() {
		if (isset($_SESSION['user'])){
			if ($_SESSION['user']['idrole'] == 3) {
				$user_contact = UserContact::findAll();
			}else{
				$user_contact = UserContact::findOne(["iduser_requestor" => $_SESSION['user']['idinternaluser'],"iduser_receiver" => $_SESSION['user']['idinternaluser']],"or");
			}
		}

		$this->render("index", array('user_contact' => $user_contact, 'internaluser' => InternalUser::findAll()));
	}

	public function admin_view() {
		try {
			$contact = new UserContact(parameters()["id"]);
			$this->render("view", array('contact' => $contact, 'response' => ResponseContact::findAll(), 'internaluser' => InternalUser::findAll()));
		} catch (Exception $e) {
			(new SiteController())->render("index");
		}
	}

	// public function send_response(){
	// 	if (isset(parameters()['answer_iduser']) and isset(parameters()['answer_iduser_respondent']) and isset(parameters()['answer_idcontact']) and isset(parameters()['answer_title']) and isset(parameters()['answer_text'])){
	// 		$responsecontact = new ResponseContact();
	// 		$responsecontact->iduser = parameters()['answer_iduser_respondent'];
	// 		$responsecontact->iduser_respondent = parameters()['answer_iduser'];
	// 		$responsecontact->iduser_contact = parameters()['answer_idcontact'];
	// 		$responsecontact->title_response = parameters()['answer_title'];
	// 		$responsecontact->text_response = parameters()['answer_text'];
	// 		$responsecontact->date_response = date("Y-m-d H:i:s");
	// 		if (isset($_SESSION['user'])){
	// 			if ($_SESSION['user']['idrole'] != 1) {
	// 				$responsecontact->admin_response = 1;
	// 			}
	// 		}
	// 		$responsecontact->insert();

	// 		$contact = new UserContact(parameters()['answer_idcontact']);
	// 		$this->render("view", array('contact' => $contact, 'response' => ResponseContact::findAll(), 'internaluser' => InternalUser::findAll()));

	// 	}  
	// }
}

