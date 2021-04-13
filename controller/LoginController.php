<?php

class LoginController extends Controller {

	public function index() {
    if (isset(parameters()["uname"]) && parameters()["psw"]) {

      $internaluser = Internaluser::attempt(parameters()["uname"], parameters()["psw"]);
      if ($internaluser) {
    
        $_SESSION["user"] = $internaluser;
        header('Location: .');
      } else {
        $this->render("index", "error");
      }
    }
    
		$this->render("index");
	}

  public function update(){

    if(isset($_SESSION["user"]["username"])
      && isset(parameters()["last_psw"])
      && isset(parameters()["new_psw"])
      && isset(parameters()["new_psw2"])) {
        if (parameters()["new_psw"] != parameters()["last_psw2"]) {
          $this->render("update", "error");
          exit();
        }

        Internaluser::attempt($_SESSION["user"]["username"], parameters()["last_psw"]);
        if (!$internaluser) {
          $this->render("update", "error");
          exit();
        }

        $internaluser["password"] = password_hash(parameters()["new_psw"]);
        $this->render("update", "success");
        exit();
    }
    else {
      $this->index();
    }
    
  }

  public function logout(){
    session_unset();
    $this->render("index");
  }

}


