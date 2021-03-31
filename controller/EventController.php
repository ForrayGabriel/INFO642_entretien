<?php

class EventController extends Controller {

	public function index() {
		$this->render("index", array('event' => Event::findAll(),'classroom' => Classroom::findAll()));
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

	public function add(){
		$this->render("add", array('event' => Event::findAll(),'classroom' => Classroom::findAll(), 'internaluser' => InternalUser::findAll()));
	}

}