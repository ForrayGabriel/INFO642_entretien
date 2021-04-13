<?php

    class PrestationController extends Controller {

        public function index() {
            print_r(new InternalUser($_SESSION["user"]["idinternaluser"]));
            $this->render("index", array('prestation'=>Prestation::findAll(), 'internaluser'=>new InternalUser($_SESSION["user"]["idinternaluser"])));
        }
        public function view() {
            try {
                $b = new Classroom(parameters()["id"]);
                $this->render("view", $b);
            } catch (Exception $e) {
                (new SiteController())->render("index");
                // $this->render("error");
            }
        }




    }



