<?php

class EventController extends Controller {

	var $rolepermissions = [1,2,3];

	public function index() {

		if (isset(parameters()["id"])) {
			$prestations = Prestation::findOne(["idevent" => parameters()["id"]]);

			$table_header = array("Evenement", "Eleve", "Salle", "Jury", "Date");

			$table_content = array();
			foreach ($prestations as &$prestation) {
				$table_content[$prestation->idprestation] = array(
					"Evenement" => $prestation->idevent->entitled_event,
					"Eleve" => $prestation->idstudent->idinternaluser->nom." ".$prestation->idstudent->idinternaluser->prenom,
					"Salle" => $prestation->idjury->idclassroom->name_classroom,
					"Jury" => $prestation->idjury->name,
					"Date" => $prestation->date_prestation
				);
			}
			// Todo
			$table_addBtn = array("text" => "Générer les prestations", "url" => "?r=event/generate&id=".parameters()["id"]);

			$this->renderComponent("table", ["header" => $table_header, "content" => $table_content, "addBtn" => $table_addBtn]);
		} else {
			$events = Event::findAll();
			$events = array_filter($events, function($event) {
				return strtotime($event->end_date) > strtotime(date("Y-m-d H:i:s"));
			});

			$table_header = array("Nom", "Description","Critères");

			$table_content = array();
			foreach ($events as &$event) {
				$table_content[$event->idevent] = array(
					"Nom" => $event->entitled_event,
					"Desc" => $event->description_event);
			}

			$table_addBtn = array("text" => "Ajouter un évènement", "url" => "?r=event/add");

			$table_rowLink = "?r=event";



			$table_actions = array(
				array("url" => "?r=evaluationcriteria/view&id=:id", "desc"=>"", "icon"=>"evaluationicon.png")
			);
	

			$this->renderComponent("table", ["header"=>$table_header, "content"=>$table_content, "addBtn"=>$table_addBtn, "rowLink"=>$table_rowLink, "actions"=>$table_actions]);
		}
	}

	public function generate() {

		if($_SERVER['REQUEST_METHOD'] == "GET") {


			
			$event = new Event(parameters()["id"]);
			$timeslots = TimeSlot::timeslotDisponible($event->start_date,$event->end_date);
			$meridiems = array();

			foreach ($timeslots as &$timeslot) {
				if (isset($meridiems[$timeslot->meridiem]))
					$meridiems[$timeslot->meridiem] += 1;
				else
					$meridiems[$timeslot->meridiem] = 1;
			}

			$half_day = 0;
			foreach ($meridiems as &$meridiem) {
				$half_day += floor($meridiem/2);
			}

            $form_title = "Générer les prestations de l'évènement ".$event->entitled_event;

			$groups = PeopleGroup::findAll();
			$options_groups = array();
			foreach ($groups as &$group) {
				$people = count(BelongGroup::findOne(["idpeoplegroup"=>$group->idpeoplegroup]));
				$options_groups[$group->title_peoplegroup." - ".$people." personnes"] = $group->idpeoplegroup;
			}

			$form_content = array(
				"Groupe" => 
					array(
						"type" => "select", 
						"desc" => "Choisir groupe", 
						"options" => $options_groups,
					),
				"Nombre de prestations dans une demi-journée" => array(
					"type" => "number",
				)
			);
			$this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content]);
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (parametersExist(["Titre", "Description", "Date_start", "Date_end", "Enseignant_responsable"])) {
				$event = new Event();
				$event->entitled_event = parameters()["Titre"];
				$event->description_event = parameters()["Description"];
				$event->start_date = parameters()["Date_start"];
				$event->end_date = parameters()["Date_end"];
				$event->idevent_creator = parameters()['Enseignant_responsable'];
				$event->insert();
				header("Location: .?r=event");
			} else {
				// go_back();
				die("ok");
			}
		}



	}


	public function historique() {
		$events = Event::findAll();
		$events = array_filter($events, function($event) {
			return strtotime($event->end_date) < strtotime(date("Y-m-d H:i:s"));
		});
	
		$table_header = array("Nom", "Description");

		$table_content = array();
		foreach ($events as &$event) {
			$table_content[$event->idevent] = array(
				"Nom" => $event->entitled_event,
				"Desc" => $event->description_event);
		}

		$table_addBtn = array("text" => "Ajouter un évènement", "url" => "?r=event/add");

		$this->renderComponent("table", ["header"=>$table_header, "content"=>$table_content, "addBtn"=>$table_addBtn]);
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

	public function add(){
		if($_SERVER['REQUEST_METHOD'] == "GET") {
            $form_title = "Ajouter un évenment";

			$teachers = InternalUser::findOne(["idrole" => 2]);
			$options = array();


			foreach ($teachers as &$teacher) {
				$options[$teacher->nom . " " . $teacher->prenom] = $teacher->idinternaluser;
			}

			$form_content = array(
				"Titre" => array("type" => "text"),
				"Description" => array("type" => "text"),
				"Enseignant responsable" => 
					array(
						"type" => "select", 
						"desc" => "Choisir enseignant responsable de l'évenment", 
						"options" => $options
					),
				"Date" => array(
					"type" => "date",
					"title" => "Date de début et de fin"
				)
			);
			$this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content]);
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (parametersExist(["Titre", "Description", "Date_start", "Date_end", "Enseignant_responsable"])) {
				$event = new Event();
				$event->entitled_event = parameters()["Titre"];
				$event->description_event = parameters()["Description"];
				$event->start_date = parameters()["Date_start"];
				$event->end_date = parameters()["Date_end"];
				$event->idevent_creator = parameters()['Enseignant_responsable'];
				$event->insert();
				header("Location: .?r=event");
			} else {
				go_back();
			}
		}

	}


}