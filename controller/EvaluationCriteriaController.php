<?php

class EvaluationcriteriaController extends Controller {

	var $rolepermissions = [1,2,3];

	public function index() {
		$this->render("index", Evaluationcriteria::findAll());
	}

	public function view() {
		if(isset(parameters()["delete"])){
			$b = new Evaluationcriteria(parameters()["id"]);
			$b->delete(parameters()["id"]);
			$this->render("index", Evaluationcriteria::findAll());
		}
			
		else{
			try {
				$b = new Evaluationcriteria(parameters()["id"]);
				$c = new Event($b->idevent);
				$this->render("view", ["evaluationcriteria" => $b,"event" => $c]);

			} catch (Exception $e) {
				(new SiteController())->render("index");
			}
		}
		
	}


	public function add() {
		if (isset(parameters()["idevent"]) and isset(parameters()["description_criteria"]) and isset(parameters()["scale_criteria"])) {
			$evalcriteria = new Evaluationcriteria();
			$evalcriteria->idevent = parameters()["idevent"];
			$evalcriteria->description_criteria = parameters()["description_criteria"];
			$evalcriteria->scale_criteria = parameters()["scale_criteria"];
			$evalcriteria->insert();
			$this->render("index", Evaluationcriteria::findAll());
		} else {
			$this->render("add", Event::findAll());
		}
	}

	public function update() {
		if(isset(parameters()["idevent"]) and isset(parameters()["description_criteria"]) and isset(parameters()["scale_criteria"])) {
			$evalcriteria = new Evaluationcriteria(parameters()["id"]);
			$evalcriteria->idevent = parameters()["idevent"];
			$evalcriteria->description_criteria = parameters()["description_criteria"];
			$evalcriteria->scale_criteria = parameters()["scale_criteria"];
			$evalcriteria->update();
			$this->render("index", Evaluationcriteria::findAll());
		}
		else{
			$b = new Evaluationcriteria(parameters()["id"]);
			$c = Event::findAll();
			$this->render("update", ["evaluationcriteria" => $b,"event" => $c]);
		}
		
	}

}


