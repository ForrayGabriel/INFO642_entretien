<?php

class ProfilController extends Controller {

    var $rolepermissions = [1,2,3];
    
    public function index(){
        $user = new InternalUser($_SESSION["user"]["idinternaluser"]);

        $updated = true;
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $updated = $user->updatePassword($user);
            if ($updated) $this::logout();
        }

        $this->render("index", ["user"=>$user,"error"=>!$updated]);
    }

    public function logout(){
        session_unset();
        header('Location: .');
    }
}