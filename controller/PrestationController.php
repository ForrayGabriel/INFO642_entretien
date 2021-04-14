<?php
/// , 'individualevaluation'=>new IndividualEvaluation::findAll()
    class PrestationController extends Controller {

        public function index() {
            $this->render("index", array('prestation'=>Prestation::findAll(), 'internaluser'=>new InternalUser($_SESSION["user"]["idinternaluser"]), ));
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


