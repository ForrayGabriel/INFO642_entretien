<?php

class ResultatController extends Controller {

	var $rolepermissions = [1,2,3];

	public function index() {
        $user = new InternalUser($_SESSION["user"]["idinternaluser"]);
        if (is_student()) {
            $student = Student::findOne(["idinternaluser" => $user->idinternaluser])[0];
            $this->student($student);
        } else if (is_teacher() || is_admin()) {
            $this->corrector($user);
        } else {
            go_back();
        }
    }

    public function student($student){
    	$prestations = Prestation::findOne(["idstudent" => $student->idinternaluser->idinternaluser]);

        $prestations = array_filter($prestations, function($prestation) {
            return strtotime($prestation->date_prestation) < strtotime(date("Y-m-d H:i:s"));
        });

        $table_header = array("Evenement", "Eleve", "Salle", "Jury", "Date");

        $table_content = array();
        foreach ($prestations as &$prestation) {
            $table_content[$prestation->idprestation] = array(
                "Evenement" => $prestation->idevent->entitled_event,
                "Eleve" => $prestation->idstudent->idinternaluser->nom." ".$prestation->idstudent->idinternaluser->prenom,
                "Salle" => $prestation->idjury->idclassroom->name_classroom,
                "Jury" => $prestation->idjury->name_jury,
                "Date" => date_format(date_create($prestation->date_prestation),'d/m/y'). " de " . $prestation->start_time . " à " . $prestation->end_time
            );
        }

        $this->renderComponent("table", ["header" => $table_header, "content" => $table_content]);
    }

    public function corrector($user){
    	print_r("resultat corrector");
    }



	
}

