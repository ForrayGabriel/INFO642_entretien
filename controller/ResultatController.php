<?php

class ResultatController extends Controller {

	var $rolepermissions = [1,2,3];

	public function index() {

		$prestations = Prestation::findOne(['idstudent' => $_SESSION['user']['idinternaluser']]);
		$events = array();
		$jurys = array();

		foreach($prestations as $prestation){
			array_push($events, Event::findOne(['idevent' => $prestation->idevent]));
			array_push($jurys, Jury::findOne(['idjury' => $prestation->idjury]));
		}

		$this->render("index", array('results' => $prestations, 'events' => $events, 'jury' => $jurys));
	}


	public function view(){
		try {
			$prestation = new Prestation(parameters()["id"]);
            $individual_evaluation = IndividualEvaluation::findOne(['idprestation' => intval(parameters()["id"])]);

            $jury = Jury::findOne(['idjury' => $prestation->idjury]);

            $this->render("view", array('prestation' => $prestation, 'individual_evaluation' => $individual_evaluation, 'criteres' => EvaluationCriteria::findAll()));
        } catch (Exception $e) {
            (new SiteController())->render("index");
        }
	}
}

