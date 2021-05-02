<?php

class GroupController extends Controller {

	var $rolepermissions = [2,3];

	public function import(){
		if($_SERVER['REQUEST_METHOD'] == "GET") {

			$radio_group = array();
			foreach(PeopleGroup::findAll() as $group){
				$radio_group[$group->title_peoplegroup] = $group->idpeoplegroup;
			}

	        $form_title = "Importer des membres";
			$form_content = array(
				"Fichier" => array("type" => "file"),
				"Role" => array("type" => "checkbox", "options" => $radio_group)
			);
			$this->renderComponent("form", ["title" => $form_title, "content" => $form_content]);

		} else {
			$fields_name = array();
			$data = array();
			if(!empty($_FILES['Fichier']['tmp_name'])){
				
				$csvAsArray = array_map('str_getcsv', file($_FILES['Fichier']['tmp_name']));
				foreach($csvAsArray as $keys => $values){
					if($keys != 0)
						$internalUser = array();

					foreach($values as $key => $value){
						if($keys == 0){
							$fields_name[$key] = $value;
						}else{
							$internalUser[$fields_name[$key]] = $value;
						}
					}

					if($keys != 0){
						$internal = new InternalUser();
						$internal->idrole = 1;
						$student = new Student();
						foreach ($internalUser as $key => $value)
						{
							if(property_exists($internal, '_' . $key))
								$internal->$key = $value;
							if(property_exists($student, '_' . $key))
								$student->$key = $value;	
						}

						// INSERT OR UPDATE


						if(!InternalUser::findOne(['email' => $internal->email])){

							// TODO : mot de passe numéro INE
							if(isset($student->num_INE)){
								$internal->password = $student->num_INE;
							}

							$get_id = $internal->insert();
							$student->idinternaluser = $get_id;
							$student->insert();	
						}else{
							$internal->update();
							$internal_last_update = InternalUser::findOne(['email' => $internal->email]);
							$get_id = $internal_last_update[0]->idinternaluser;
							$student->idinternaluser = $get_id;

							$student->update();	
						}

						// INSERT GROUP BELONG

						if(isset($_POST['Role_'])){
							foreach($_POST['Role_'] as $group){
								if(!BelongGroup::findOne(['idinternaluser' => $get_id, 'idpeoplegroup' => $group])){
									$belong = new BelongGroup();
									$belong->idinternaluser = $get_id;
									$belong->idpeoplegroup = $group;
									$belong->insert();
								}
							}
						}
					}
					
				}
			}
			go_back();
		}

	}

}