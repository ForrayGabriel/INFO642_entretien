<?php

class LoginController extends Controller {

	public function index() {
		$this->render("index");
	}

    public function attempt() {
      // TODO hash password
      $internaluser = new Internaluser(parameters()["uname"], parameters()["psw"]);
      if ($internaluser->idinternaluser) {
        header('Location: .?r=classroom');
      } else {
        // TODO add error 
        $this->render("index");
      }
      
      $_SESSION["user"] = $internaluser;
	}

}


