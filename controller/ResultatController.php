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
            return strtotime($prestation->date_prestation) < strtotime(date("Y-m-d"));
        });

        $table_header = array("Evenement", "Eleve", "Salle", "Jury", "Date","Etat","Action");

        $table_content = array();
        foreach ($prestations as &$prestation) {

            $table_content[$prestation->idprestation] = array(
                "Evenement" => $prestation->idevent->entitled_event,
                "Eleve" => $prestation->idstudent->idinternaluser->nom." ".$prestation->idstudent->idinternaluser->prenom,
                "Salle" => $prestation->idjury->idclassroom->name_classroom,
                "Jury" => $prestation->idjury->name_jury,
                "Date" => date_format(date_create($prestation->date_prestation),'d/m/y'). " de " . $prestation->start_time . " à " . $prestation->end_time,
                "Etat" => $prestation->idnotationstate->state
            );

            if($prestation->idnotationstate->idnotationstate == 3){
                $table_content[$prestation->idprestation]['button'] = "<a style='text-decoration: none;' href='?r=resultat/report&id=" . $prestation->idprestation . "'><button class='button' type='button'>Mes résultats</button></a> ";
            }else{
                $table_content[$prestation->idprestation]['button'] = "";
            }
        }

        $no_data = "Aucun résultat disponible";
        $this->renderComponent("table", ["header" => $table_header, "content" => $table_content, "no_data" => $no_data]);
    }

    public function corrector($user){
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
                return strtotime($prestation->date_prestation) < strtotime(date("Y-m-d"));
            });

            $table_header = array("Evenement", "Eleve", "Salle", "Jury", "Date","Action");
            $table_content = array();
            foreach ($prestations as &$prestation) {
                $table_content[$prestation->idprestation] = array(
                    "Evenement" => $prestation->idevent->entitled_event,
                    "Eleve" => $prestation->idstudent->idinternaluser->nom." ".$prestation->idstudent->idinternaluser->prenom,
                    "Salle" => $prestation->idjury->idclassroom->name_classroom,
                    "Jury" => $prestation->idjury->name_jury,
                    "Date" => date_format(date_create($prestation->date_prestation),'d/m/y'). " de " . $prestation->start_time . " à " . $prestation->end_time
                );

                $table_content[$prestation->idprestation]['button'] = "<a style='text-decoration: none;' href='?r=resultat/report&id=" . $prestation->idprestation . "'><button class='button' type='button'>Résultats</button></a> ";

            }

            $no_data = "Aucune prestation passé";
            $this->renderComponent("table", ["header" => $table_header, "content" => $table_content, "no_data" => $no_data]);   
    }

    public function report(){
        id_or_back(parameters());
        $evaluations = IndividualEvaluation::findOne(['idprestation' => parameters()['id']]);

        $prestation = new Prestation(parameters()['id']);

        $table_header = array("Critère de notation","Note");

        $table_content = array();

        $data = array();
        $count = array();
        $comment = array();
        $sum = 0;

        foreach($evaluations as $evaluation){
            if(!isset(($data[$evaluation->idevaluationcriteria->description_criteria]))){
                $data[$evaluation->idevaluationcriteria->description_criteria] = 0;
                $count[$evaluation->idevaluationcriteria->description_criteria] = 0;
            }
            if($evaluation->individual_note){
                $data[$evaluation->idevaluationcriteria->description_criteria] += (int) $evaluation->individual_note;
                $count[$evaluation->idevaluationcriteria->description_criteria]++;
            }
        }

        foreach($data as $key => $value){
            $table_content[$key]["Critère de notation"] = $key;
            $table_content[$key]["Note"] = $value / $count[$key];
            $sum += $value / $count[$key];
        }

        $table_content["avg"][""] = "<b> Moyenne de l'examen <b>";
        if(count($count) == 0){
            $table_content["avg"]["Note"] = "<b> Non évalué </b>" ;
        }else{
            $table_content["avg"]["Note"] = "<b>" . $sum / count($count) . "</b>" ;
        }

        $table_content["comment"]["Commentaire"] = $prestation->comment_jury; 
        $table_content["comment"][""] = ""; 

        $this->renderComponent("table", ["header" => $table_header, "content" => $table_content]);
    }



	
}

