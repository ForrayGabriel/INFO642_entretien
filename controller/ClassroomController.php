<?php

class ClassroomController extends Controller {

	public function index() {
		$this->render("index", Classroom::findAll());
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
		if (isset(parameters()["name_classroom"])) {
			$classroom = new Classroom();
			$classroom->name_classroom = parameters()["name_classroom"];
			$classroom->building_classroom = parameters()["building_classroom"];
			$classroom->capacity_classroom = parameters()["capacity_classroom"];
			$classroom->insert();
			$this->render("index", Classroom::findAll());
		} else {
			$this->render("add");
		}
	}

	public function delete(){
		if (isset(parameters()["id"])) {
			$classroom = new Classroom();
			$classroom->delete(parameters()["id"]);
		}
		$this->render("index", Classroom::findAll());
	}

}


