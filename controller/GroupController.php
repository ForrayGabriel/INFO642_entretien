<?php

class GroupController extends Controller {
	public function index(){
		$this->render("index");
	}

	public function send(){

		$fields_name = array();
		$data = array();

		if(!empty($_FILES['users']['tmp_name'])){
			$csvAsArray = array_map('str_getcsv', file($_FILES['users']['tmp_name']));
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
					if(!InternalUser::findOne(['email' => $internal->email])){
						$get_id = $internal->insert();
						$student->idinternaluser = $get_id;
						$student->insert();	
					}else{
						$get_id = $internal->update();
						$student->idinternaluser = $get_id;
						$student->update();	
					}
				}
				
			}
		}
	}
}