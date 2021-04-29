<?php

class EventController extends Controller {

	public function index() {
		$events = Event::findAll();
		$events = array_filter($events, function($event) {
			return strtotime($event->end_date) > strtotime(date("Y-m-d H:i:s"));
		});
		$this->render("index", $events);
	}

	public function historique() {
		$events = Event::findAll();
		$events = array_filter($events, function($event) {
			return strtotime($event->end_date) < strtotime(date("Y-m-d H:i:s"));
		});
		$this->render("index", $events);
	}

	public function view() {
		try {
			$object = new Event(parameters()["id"]);
			$this->render("view", array('object' => $object));
		} catch (Exception $e) {
			(new SiteController())->render("index");
			// $this->render("error");
		}
	}

	public function update_view(){
		$object = new Event(parameters()["id"]);

		foreach(Role::findAll() as $role){
			if($role->name_role == "Etudiant"){
				$role_ban = $role->idrole;
			}
		}

		foreach(InternalUser::findAll() as $user){
			if($user->idinternaluser == $object->idevent_creator){
				$actual_creator = $user;
			}
		}

		
		$this->render("update", array('object' => $object,'internaluser' => InternalUser::findAll(), 'role_ban' => $role_ban, 'actual_creator' => $actual_creator));
	}

	public function update_event(){
		if(isset(parameters()['idevent_creator']) and parameters()['idevent_creator']  != 0 and isset(parameters()['entitled_event']) and isset(parameters()['description_event']) and isset(parameters()['start_date']) and isset(parameters()['end_date']) and isset(parameters()['idevent'])){

			$event = new Event(parameters()['idevent']);
			$event->entitled_event = parameters()["entitled_event"];
			$event->description_event = parameters()["description_event"];
			$event->start_date = parameters()["start_date"];
			$event->end_date = parameters()["end_date"];
			$event->idevent_creator = parameters()['idevent_creator'];
			
			$event->update();
		}
		$this->render("index", array('event' => Event::findAll(),'classroom' => Classroom::findAll(), 'internaluser' => InternalUser::findAll()));

	}

	public function add_view(){
		foreach(Role::findAll() as $role){
			if($role->name_role == "Etudiant"){
				$role_ban = $role->idrole;
			}
		}
		$this->render("add", array('event' => Event::findAll(),'classroom' => Classroom::findAll(), 'internaluser' => InternalUser::findAll(), 'role_ban' => $role_ban));
	}

	public function add_event(){
		if(isset(parameters()['idevent_creator']) and parameters()['idevent_creator']  != 0 and isset(parameters()['entitled_event']) and isset(parameters()['description_event']) and isset(parameters()['start_date']) and isset(parameters()['end_date'])){

			$event = new Event();
			$event->entitled_event = parameters()["entitled_event"];
			$event->description_event = parameters()["description_event"];
			$event->start_date = parameters()["start_date"];
			$event->end_date = parameters()["end_date"];
			$event->idevent_creator = parameters()['idevent_creator'];
			
			$event->insert();
		}
		$this->render("index", array('event' => Event::findAll(),'classroom' => Classroom::findAll(), 'internaluser' => InternalUser::findAll()));

	}

}