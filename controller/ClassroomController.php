<?php

class ClassroomController extends Controller {

	var $rolepermissions = [3];

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
			$classroom->description_classroom = parameters()["description_classroom"];
			$classroom->insert();
			$this->render("index", Classroom::findAll());
		} else {
			$this->render("add");
		}
	}

	public function update(){
		if(isset(parameters()["name_classroom"]) and isset(parameters()["building_classroom"]) and isset(parameters()["capacity_classroom"]) and isset(parameters()["description_classroom"])) {
			$classroom = new Classroom(parameters()["id"]);
			$classroom->name_classroom = parameters()["name_classroom"];
			$classroom->building_classroom = parameters()["building_classroom"];
			$classroom->capacity_classroom = parameters()["capacity_classroom"];
			$classroom->description_classroom = parameters()["description_classroom"];
			$classroom->update();
			$this->render("index", Classroom::findAll());
		}
		else{
			$b = new Classroom(parameters()["id"]);
			$this->render("update", $b);
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


