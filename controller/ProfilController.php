<?php

class ProfilController extends Controller {

	public function index() {
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
        $this->render("update");
        }
        
    }

    public function logout(){
        session_unset();
        header('Location: .');
    }

}


