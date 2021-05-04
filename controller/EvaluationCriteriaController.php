<?php

class EvaluationcriteriaController extends Controller {

	var $rolepermissions = [1,2,3];

	public function view() {
		id_or_back(parameters());

		$id_event = parameters()['id'];

		$evaluation_criterias = EvaluationCriteria::findOne(['idevent' => $id_event]);

		$table_header = array("Description", "Scale");

        $table_content = array();
        foreach ($evaluation_criterias as &$criteria) {
            $table_content[$criteria->idevaluationcriteria] = array(
                "Description" => $criteria->description_criteria,
                "Scale" => $criteria->scale_criteria
            );
        }

        $table_actions = array(
			array("url" => "?r=evaluationcriteria/update&id=:id", "desc" => "", "icon" => "updatepasswordicon.png"),
			array("url" => "?r=evaluationcriteria/delete&id=:id", "desc" => "", "icon" => "removeicon.png")
		);

        $table_addBtn = array("text" => "Ajouter un critère", "url" => "?r=evaluationcriteria/add&id=".$id_event);


        $this->renderComponent("table", ["header" => $table_header, "content" => $table_content, "addBtn" => $table_addBtn, "actions" => $table_actions]);
	
	}

	public function add(){
		id_or_back(parameters());

		$id_event = parameters()['id'];

		if($_SERVER['REQUEST_METHOD'] == "GET") {
			$event = Event::findOne(['idevent' => $id_event]);

			$form_title = "Ajouter un critère pour l'évenement " . $event[0]->entitled_event;
			$options = array();

			$form_content = array(
				"Nom du critère" => array("type" => "text"),
				"Echelle du critère" => array("type" => "text")
			
			);
			$this->renderComponent("form", ["title" => $form_title, "content" => $form_content]);
		}else{
			if (parametersExist(["Nom_du_critère", "Echelle_du_critère"])) {
				$evaluation_crtieria = new EvaluationCriteria();
				$evaluation_crtieria->description_criteria = parameters()['Nom_du_critère'];
				$evaluation_crtieria->scale_criteria = parameters()['Echelle_du_critère'];
				$evaluation_crtieria->idevent = $id_event;
				$insert = $evaluation_crtieria->insert();

				$this->view();
			}
		}
	}

	public function update(){
		id_or_back(parameters());

		if($_SERVER['REQUEST_METHOD'] == "GET") {
			$object = new EvaluationCriteria(parameters()["id"]);
			$form_title = "Modifier un critère d'évaluation";
			$form_content = array(
				"Nom du critère" => array("type" => "text", "value" => $object->description_criteria),
				"Echelle du critère" => array("type" => "text", "value" => $object->scale_criteria)
			);
			$this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content]);
		}else{
			if (parametersExist(["Nom_du_critère", "Echelle_du_critère"])) {
				$evaluationcriteria = new EvaluationCriteria(parameters()["id"]);
				$evaluationcriteria->description_criteria = parameters()['Nom_du_critère'];
				$evaluationcriteria->scale_criteria = parameters()['Echelle_du_critère'];
				$evaluationcriteria->update();
				$this->view();
			}else{
				go_back();
			}
		}
	}

	public function delete(){
		id_or_back(parameters());

		if(isset(parameters()['id'])){
			$evaluation_criteria = new EvaluationCriteria(parameters()['id']);
			$evaluation_criteria->delete();
		}

		go_back();
	}
}


