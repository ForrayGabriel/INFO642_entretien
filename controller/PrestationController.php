<?php
    class PrestationController extends Controller {

        var $rolepermissions = [1,2,3];

        public function index() {

            $user = new InternalUser($_SESSION["user"]["idinternaluser"]);
            $prestations = $user->getEnseignantPrestations();
            
            $this->render("index", $prestations);
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

        public function add() {
            if (isset(parameters()["idindividualevaluation"])) {
                $prestation = new Prestation();
                $prestation->idcompose = parameters()["idcompose"];
                $prestation->idevaluationcriteria = parameters()["idevaluationcriteria"];
                $prestation->idprestation = parameters()["idprestation"];
                $prestation->individual_comment = parameters()["individual_comment"];
                $prestation->individual_note = parameters()["individual_note"];
                $prestation->insert();
                $this->render("index", Classroom::findAll());
            } else {
                $prestation = new Prestation(parameters()["id"]);
                $event = Evaluationcriteria::findOne(["idevent"=>$prestation->idprestation]);
                $this->render("add", array('prestation'=>$prestation, 'evalcritere'=>$event));

            }
        }

    }



