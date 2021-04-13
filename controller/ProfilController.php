<?php

class ProfilController extends Controller {

	public function index() {
		$this->render("index");
	}

    // public function update(){
    //     if($_SERVER['REQUEST_METHOD'] == "POST") {
    //         unset(parameters()['r']);
    //         foreach (parameters() as $key => $value) {
    //             $internaluser = new Internaluser($_SESSION["user"]["idinternaluser"]);
    //             if ($key instanceof classname)
    //                 $internaluser->$key = $value;
    //             }
    //         }
    //         $internaluser->update();
    //     }
    //     $this->render("index");
    // }

// test
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


