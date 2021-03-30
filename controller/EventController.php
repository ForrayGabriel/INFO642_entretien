<?php

class EventController extends Controller {

	public function index() {
		$this->render("index", Event::findAll());
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