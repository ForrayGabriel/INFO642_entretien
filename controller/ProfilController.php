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

            $internaluser["password"] = password_hash(parameters()["new_psw"], PASSWORD_DEFAULT);
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

    public function update_mdp_tmp(){
        if(isset(parameters()["last_psw"])
        && isset(parameters()["new_psw"])
        && isset(parameters()["new_psw2"])) {
            $internaluser = new Internaluser($_SESSION["user"]["idinternaluser"]);
            if (parameters()["new_psw"] != parameters()["new_psw2"]) {
                $this->render("update_mdp_tmp", "error1");
                exit();
            }
            if (!password_verify(parameters()["last_psw"], $internaluser->password)) {
                $this->render("update_mdp_tmp", "error2");
                exit();
            }

            $internaluser->password = password_hash(parameters()["new_psw"], PASSWORD_DEFAULT);
            $internaluser->update();
            $this->render("update_mdp_tmp", "success");
            exit();
        }
        else {
        $this->render("update_mdp_tmp", "aezeaz");
        }
    }

}


