<?php

class LoginController extends Controller {

	public function index() {
    if (isset(parameters()["uname"]) && parameters()["psw"]) {

      $internaluser = Internaluser::attempt(parameters()["uname"], parameters()["psw"]);
      if ($internaluser) {
    
        $_SESSION["user"] = $internaluser;
        header('Location: .');
      } else {
        // TODO add error
        $this->render("index", "error");
      }
    }
    
		$this->render("index");
	}

  public function logout(){
    unset($_SESSION);
    $this->render("index");
  }

}


