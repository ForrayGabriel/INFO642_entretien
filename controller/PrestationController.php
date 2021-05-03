<?php
    class PrestationController extends Controller {

        var $rolepermissions = [1,2,3];

        public function index() {
            $user = new InternalUser($_SESSION["user"]["idinternaluser"]);
            if (is_student()) {
                $student = Student::findOne(["idinternaluser" => $user->idinternaluser])[0];
                $this->student($student);
            } else if (is_teacher() || is_admin()) {
                $this->teacher($user);
            } else {
                go_back();
            }
        }

        // STUDENT 

        public function student($student) {
            $prestations = Prestation::findOne(["idstudent" => $student->idinternaluser->idinternaluser]);

            $prestations = array_filter($prestations, function($prestation) {
                return strtotime($prestation->date_prestation) > strtotime(date("Y-m-d H:i:s"));
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

        public function teacher($user) {
            
            $table_content = array();
            $prestations = $user->getEnseignantPrestations();
            foreach ($prestations as $key => $prestation) {
                $prestations[$key] = new Prestation($prestation["idprestation"]);
            }

            $prestations = array_filter($prestations, function($prestation) {
                return strtotime($prestation->date_prestation) > strtotime(date("Y-m-d H:i:s"));
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

            $table_actions = array(
                array("url" => "?r=prestation/notation&id=:id", "desc" => "", "icon" => "updatepasswordicon.png")
            );
        
            $this->renderComponent("table", ["header" => $table_header, "content" => $table_content, "actions" => $table_actions]);    
        }

        public function notation(){
            $prestation = new Prestation(parameters()['id']);
            $event = new Event($prestation->idprestation);
            $evaluations_criterias = EvaluationCriteria::findOne(['idevent' => $event->idevent]);


            $object = new Prestation();
            $form_title = "Noter une prestation";
            $form_content = array(
                "Nom du critère" => array("type" => "text"),
                "Echelle du critère" => array("type" => "text")
            );

            foreach($evaluations_criterias as $criteria){
                    //TODO
            }

            $this->renderComponent("form", ["title"=>$form_title, "content"=>$form_content]);

        }

    }



