<?php

class ClassroomController extends Controller {

	var $rolepermissions = [3];

	public function index() {
		$classrooms = Classroom::findAll();

		$table_header = array("Numéro de la salle", "Bâtiment","Capacité", "Description");
    
		$table_content = array();
		foreach ($classrooms as &$classroom) {
			$table_content[$classroom->idclassroom] = array(
				"Numéro de la salle" => $classroom->name_classroom,
				"Bâtiment" => $classroom->building_classroom,
				"Capacité" => $classroom->capacity_classroom,
				"Description" => $classroom->description_classroom,
			);
		}
		
	
		$table_addBtn = array("text" => "Ajouter une salle", "url" => "?r=classroom/add");
	
		$table_actions = array(
			array("url" => "?r=classroom/update&id=:id", "desc"=>"", "icon"=>"update.png"),
			array("url" => "?r=classroom/delete&id=:id", "desc"=>"Supprimer la salle", "icon"=>"removeicon.png"));
		
		$no_data = "Aucune salle n'existe, vous pouvez en créer en cliquant sur le bouton ajouter";
		$this->renderComponent("table", ["header"=>$table_header, "content"=>$table_content, "addBtn"=>$table_addBtn, "actions"=>$table_actions, "no_data"=>$no_data]);
	}

	public function update() {
		id_or_back(parameters());
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			$classroom = new Classroom(parameters()["id"]);
			$form_title = "Modifier une salle";
			$form_content = array(
				"Nom de la salle" => array("type" => "text", "value" => $classroom->name_classroom),
				"Nom du bâtiment" => array("type" => "text", "value" => $classroom->building_classroom),
				"Capacité de la classe" => array("type" => "text", "value" => $classroom->capacity_classroom),
				"Description" => array("type" => "text", "value" => $classroom->description_classroom, "!required" => 1)
			);
			$this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content]);
		}else{
			if(!parametersExist(["Nom_de_la_salle", "Nom_du_bâtiment", "Capacité_de_la_classe", "Description"])) {
				$classroom = new Classroom(parameters()["id"]);
				$classroom->name_classroom = parameters()["Nom_de_la_salle"];
				$classroom->building_classroom = parameters()["Nom_du_bâtiment"];
				$classroom->capacity_classroom = parameters()["Capacité_de_la_classe"];
				$classroom->description_classroom = parameters()["Description"];
				$classroom->update();
				$this->index();
			}else{
				go_back();
			}
		}
	}

	public function add() {

		if($_SERVER['REQUEST_METHOD'] == "GET") {
			$form_title = "Ajouter une salle";
			$form_content = array(
				"Nom de la salle" => array("type" => "text"),
				"Nom du bâtiment" => array("type" => "text"),
				"Capacité de la classe" => array("type" => "text"),
				"Description" => array("type" => "text", "!required" => 1)
			);
			$this->renderComponent("form", ["title" => $form_title, "content" => $form_content]);
		}else{
			if(isset(parameters()["Nom_de_la_salle"]) and isset(parameters()["Nom_du_bâtiment"]) and isset(parameters()["Capacité_de_la_classe"]) and isset(parameters()["Description"])) {
				$classroom = new Classroom();
				$classroom->name_classroom = parameters()["Nom_de_la_salle"];
				$classroom->building_classroom = parameters()["Nom_du_bâtiment"];
				$classroom->capacity_classroom = parameters()["Capacité_de_la_classe"];
				$classroom->description_classroom = parameters()["Description"];
				$classroom->insert();
				$this->index();
			}else{
				go_back();
			}
		}

		if (isset(parameters()["name_classroom"])) {
			$classroom = new Classroom();
			$classroom->name_classroom = parameters()["name_classroom"];
			$classroom->building_classroom = parameters()["building_classroom"];
			$classroom->capacity_classroom = parameters()["capacity_classroom"];
			$classroom->description_classroom = parameters()["description_classroom"];
			$classroom->insert();
			$this->index();
		}
	}

	public function delete(){
		if (isset(parameters()["id"])) {
			$classroom = new Classroom(parameters()["id"]);
			$classroom->delete();
		}
		$this->index();
	}

}


