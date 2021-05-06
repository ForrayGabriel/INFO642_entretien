<?php
    class PrestationController extends Controller {

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

        // STUDENT

        public function student($student) {
            $prestations = Prestation::findOne(["idstudent" => $student->idinternaluser->idinternaluser]);

            $prestations = array_filter($prestations, function($prestation) {
                return strtotime($prestation->date_prestation) >= strtotime(date("Y-m-d"));
            });

            $table_header = array("Evenement", "Eleve", "Salle", "Jury", "Date","Convocation");

            $table_content = array();
            foreach ($prestations as &$prestation) {
                $table_content[$prestation->idprestation] = array(
                    "Evenement" => $prestation->idevent->entitled_event,
                    "Eleve" => $prestation->idstudent->idinternaluser->nom." ".$prestation->idstudent->idinternaluser->prenom,
                    "Salle" => $prestation->idjury->idclassroom->name_classroom,
                    "Jury" => $prestation->idjury->name_jury,
                    "Date" => date_format(date_create($prestation->date_prestation),'d/m/y'). " de " . substr($prestation->start_time,0,5)  . " à " . substr($prestation->end_time,0,5),
                    "Convocation" => "<a target='_blank' style='text-decoration: none;' href='?r=convocation/generate&id=" . $prestation->idprestation . "'><button class='button' type='button'>📋 Ma convocation</button></a> "
                );
            }

            $no_data = "Aucune prestation à venir";
            $this->renderComponent("table", ["header" => $table_header, "content" => $table_content, "no_data"=>$no_data]);
        }

        public function corrector($user) {
            if(is_teacher()){
                $prestations = $user->getEnseignantPrestations();
            }else if(is_admin()){
                // TODO : select if admin
                $prestations = $user->getEnseignantPrestations();
            }

            foreach ($prestations as $key => $prestation) {
                $prestations[$key] = new Prestation($prestation["idprestation"]);
            }

            $prestations = array_filter($prestations, function($prestation) {
                return strtotime($prestation->date_prestation) >= strtotime(date("Y-m-d"));
            });

            $table_header = array("Evenement", "Eleve", "Salle", "Jury", "Date","Etat");
            $table_content = array();
            foreach ($prestations as &$prestation) {
                $table_content[$prestation->idprestation] = array(
                    "Evenement" => $prestation->idevent->entitled_event,
                    "Eleve" => $prestation->idstudent->idinternaluser->nom." ".$prestation->idstudent->idinternaluser->prenom,
                    "Salle" => $prestation->idjury->idclassroom->name_classroom,
                    "Jury" => $prestation->idjury->name_jury,
                    "Date" => date_format(date_create($prestation->date_prestation),'d/m/y'). " de " . substr($prestation->start_time,0,5)  . " à " . substr($prestation->end_time,0,5)
                );

                if($prestation->idnotationstate->idnotationstate == 3){
                    $table_content[$prestation->idprestation]["Etat"] = "✅ Résultat validé";
                }else{
                    $table_content[$prestation->idprestation]["Etat"] = "<a style='text-decoration: none;' href='?r=prestation/validate&id=" . $prestation->idprestation . "'><button class='button' type='button'>❌ Résultat non validé</button></a> ";
                }
            }

            $table_actions = array(
                array("url" => "?r=prestation/notation&id=:id", "desc" => "", "icon" => "evaluationicon.png")
            );

            $no_data = "Aucune prestation à venir";
            $this->renderComponent("table", ["header" => $table_header, "content" => $table_content, "actions" => $table_actions, "no_data"=> $no_data]);
        }

        public function notation(){
            id_or_back(parameters());

            $prestation = new Prestation(parameters()['id']);
            $id_event = $prestation->idevent->idevent;
            $evaluations_criterias = EvaluationCriteria::findOne(['idevent' => $id_event]);

            if($_SERVER['REQUEST_METHOD'] == "GET"){

                $form_title = "Noter une prestation";

                $form_content = array();

                foreach($evaluations_criterias as $criteria){

                    $individual_evaluation = IndividualEvaluation::findOne(['idevaluationcriteria' => $criteria->idevaluationcriteria, 'idprestation' => parameters()['id']]);

                    if($individual_evaluation && $individual_evaluation[0]->idcompose->idinternaluser->idinternaluser == get_id()){
                        $form_content[$criteria->description_criteria] = array("type" => "text", "placeholder" => $individual_evaluation[0]->individual_note, "value" => $individual_evaluation[0]->individual_note);
                    }else{
                        $form_content[$criteria->description_criteria] = array("type" => "text", "placeholder" => $criteria->scale_criteria);
                    }
                }

                if($prestation->comment_jury != ""){
                    $form_content["Commentaire Globale"] = array("type" => "text", "placeholder" => "Donner un avis pour la prestation", "placeholder" => $prestation->comment_jury, "value" => $prestation->comment_jury);
                }else{
                    $form_content["Commentaire Globale"] = array("type" => "text", "placeholder" => "Donner un avis pour la prestation");
                }

                $this->renderComponent("form", ["title" => $form_title, "content" => $form_content]);
            }else{

                $data = array();

                foreach($evaluations_criterias as $evaluation_criteria){
                    $data[str_replace("'", "", str_replace(" ","_",$evaluation_criteria->description_criteria))] = $evaluation_criteria->idevaluationcriteria;
                }

                if(isset(parameters()["Commentaire_Globale"])){
                    $general_comment = parameters()["Commentaire_Globale"];
                }

                foreach(parameters() as $key => $value){
                    if(!in_array($key,["r","id"]) && $key != "Commentaire_Globale"){
                        $compose = Compose::findOne(['idjury' => $prestation->idjury->idjury, 'idinternaluser' => get_id()]);

                        $individual_evaluation = IndividualEvaluation::findOne(['idprestation' => parameters()['id'], 'idevaluationcriteria' => $data[$key], 'idcompose' => $compose[0]->idcompose]);

                        $insert = False;
                        if(!$individual_evaluation){
                            $insert = True;
                            $individual_evaluation = new IndividualEvaluation();
                        }else{
                            $individual_evaluation = $individual_evaluation[0];
                        }

                        $individual_evaluation->idprestation = parameters()['id'];
                        $individual_evaluation->idevaluationcriteria = $data[$key];
                        $individual_evaluation->idcompose = $compose[0]->idcompose;
                        $individual_evaluation->individual_note = $value;

                        $prestation = new Prestation(parameters()['id']);
                        if($general_comment){
                            $prestation->comment_jury = $general_comment;
                        }else{
                            $prestation->comment_jury = "Aucune commentaire pour cette prestation";
                        }
                        $prestation->update();

                        if($insert){
                            $individual_evaluation->insert();
                        }else{
                            $individual_evaluation->update();
                        }
                    }

                    go_back();

                }
            }
        }

        public function validate(){
            id_or_back(parameters());
            $prestation = new Prestation(parameters()['id']);
            $prestation->idnotationstate = 3;
            $prestation->update();
            go_back();
        }
    }
