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

			$this->renderComponent("table", ["header" => $table_header, "content" => $table_content]);
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

	
	
	static public function generate() {

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
		$message = null;
		$form_title = "Ajouter un évenment";
		$groups = PeopleGroup::findAll();
		$options_groups = array();
		foreach ($groups as &$group) {
			$people = count(BelongGroup::findOne(["idpeoplegroup"=>$group->idpeoplegroup]));
			$options_groups[$group->title_peoplegroup." - ".$people." personnes"] = $group->idpeoplegroup;
		}
		
		$teachers = InternalUser::findOne(["idrole" => 2]);
		$options_enseignants = array();
		foreach ($teachers as &$teacher) {
			$options_enseignants[$teacher->nom . " " . $teacher->prenom] = $teacher->idinternaluser;
		}

		$form_content = array(
			"Titre" => array("type" => "text"),
			"Description" => array("type" => "text"),
			"Enseignant responsable" => 
				array(
					"type" => "select", 
					"desc" => "Choisir enseignant responsable de l'évenment", 
					"options" => $options_enseignants
				),
			"Date" => array(
				"type" => "date",
				"title" => "Date de début et de fin"
			),
			"Groupe" => 
				array(
					"type" => "select", 
					"desc" => "Choisir groupe", 
					"options" => $options_groups,
				),
			"Nombre d'enseignant par jury" => array(
				"type" => "number",
			),
			"Nombre de prestation dans une demi-journée" => array(
				"type" => "number",
			)
		);
		
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (!parametersExist(["Titre", "Description", "Date_start", "Date_end", "Enseignant_responsable", 
				"Groupe", "Nombre_denseignant_par_jury", "Nombre_de_prestation_dans_une_demi-journée"])) {
				$message = ["type"=>"error", "content"=>"Erreur lors de l'insertion"];
			}

			if ($message === null) {
				$group = new PeopleGroup(parameters()["Groupe"]);
				$students = BelongGroup::findOne(["idpeoplegroup"=>$group->idpeoplegroup]);

				// Nombre de jury disponible pour chaque demi-journée
				$timeslots = TimeSlot::timeslotDisponible(parameters()["Date_start"],parameters()["Date_end"]);
				$teachers_disponibility = array();
				foreach ($timeslots as &$timeslot) {
					if (isset($teachers_disponibility[$timeslot->meridiem])) {
						$teachers_disponibility[$timeslot->meridiem]["number"] += 1;
						$teachers_disponibility[$timeslot->meridiem]["teachers"][] = $timeslot->idinternaluser;
					} else {
						$teachers_disponibility[$timeslot->meridiem] = ["number" => 1, "teachers"=>[$timeslot->idinternaluser]];
					}
				}

				// Nombre de jury disponible
				$jury_disponibility = 0;
				foreach ($teachers_disponibility as &$meridiem) {
					$jury_disponibility += floor($meridiem["number"]/parameters()["Nombre_denseignant_par_jury"]);
				}

				// Nombre de jury nécessaire
				$nb_jury_needs = ceil(count($students) / parameters()["Nombre_de_prestation_dans_une_demi-journée"]);

				if ($jury_disponibility < $nb_jury_needs)
					$message = ["type"=>"error", "content"=>"Nombre de professeurs disponibles insuffisants"];
			}

			if ($message === null) {
				// Création de l'evenement
				$event = new Event();
				$event->entitled_event = parameters()["Titre"];
				$event->description_event = parameters()["Description"];
				$event->start_date = parameters()["Date_start"];
				$event->end_date = parameters()["Date_end"];
				$event->idevent_creator = parameters()['Enseignant_responsable'];
				$idevent = $event->insert();
				
				$classrooms = Classroom::findAll();
				while ($nb_jury_needs > 0) {
					
					// Création des jury
					foreach($teachers_disponibility as $date => $teacher_disponibility) {
						for ($i=0; $i < floor($teacher_disponibility["number"]/parameters()["Nombre_denseignant_par_jury"]); $i++) {
							$nb_jury_needs -= 1;
							
							$jury = new Jury();
							$jury->idclassroom = $classrooms[array_rand($classrooms)]->idclassroom;
							$jury->name_jury = "";
							$jury->meridiem = $date;
							$jury = new Jury($jury->insert());

							$composes = array();
							for ($j=0; $j < parameters()["Nombre_denseignant_par_jury"]; $j++) { 
								$jury->name .= $teacher_disponibility["teachers"][$i+$j]->nom." ";
								$compose = new Compose();
								$compose->idjury = $jury->idjury;
								$compose->idinternaluser = $teacher_disponibility["teachers"][$j]->idinternaluser;
								$compose->insert();
							}
							$jury->update();

							$prestation_duration = 4*60*60 / parameters()["Nombre_de_prestation_dans_une_demi-journée"];

							for ($j=0; $j < parameters()["Nombre_de_prestation_dans_une_demi-journée"]; $j++) { 
								$prestation = new Prestation();
								$prestation->idstudent = array_pop($students)->idinternaluser->idinternaluser;
								$prestation->idjury = $jury->idjury;
								$prestation->idevent = $idevent;
								$prestation->date_prestation = $date;
								$prestation->start_time = date('H:i:s', strtotime(substr($date,11))+$prestation_duration*$j);
								$prestation->end_time = date('H:i:s', strtotime(substr($date,11))+$prestation_duration*($j+1));
								$prestation->insert();

								if ($students == null) {
									header("Location: .?r=event");
									return;
								}
							}
						}
					}
				}
			}
		}

		$this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content, "message"=>$message]);

	}


}