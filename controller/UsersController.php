<?php

class UsersController extends Controller {
	public function index() {
		$users = Internaluser::findAll();
		$this->render("index", $users);
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


