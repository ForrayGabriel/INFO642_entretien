<?php
    class PrestationController extends Controller {

        var $rolepermissions = [1,2,3];

        public function index() {
            $user = new InternalUser($_SESSION["user"]["idinternaluser"]);
            if (is_student()) {
                $student = Student::findOne(["idinternaluser" => $user->idinternaluser])[0];
                $this->student($student, "comming");
                die();
            } else if (is_teacher()) {
                $this->teacher($user, "comming");
            } else {
                print("TODO");
                die();
            }
        }

        public function resultat() {
            $user = new InternalUser($_SESSION["user"]["idinternaluser"]);
            $this->student($user, "noted");
        }

        public function historique() {
            $user = new InternalUser($_SESSION["user"]["idinternaluser"]);
            if (is_student()) {
                header('Location: ?r=prestation/resultat');
            } else if (is_teacher()) {
                $this->teacher($user, "history");
            } else {
                print("TODO");
                die();
            }
        }

        public function notation() {
            $user = new InternalUser($_SESSION["user"]["idinternaluser"]);
            $this->teacher($user, "wait_notation");
        }

        public function admin($user) {

        }

        public function student($student, $state) {
            print("il faut changer pour mettre noter ou non plutot que faire le test par la date");
            $prestations = Prestation::findOne(["idstudent" => $student->idstudent]);
            if ($state == "comming") {
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
                            "Jury" => $prestation->idjury->name,
                            "Date" => $prestation->date_prestation
                        );
                    }
            } else if ($state == "noted") {
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
                        "Jury" => $prestation->idjury->name,
                        "Date" => $prestation->date_prestation
                    );
                }
            }
            $this->renderComponent("table", ["header"=>$table_header, "content"=>$table_content]);
        }

        public function teacher($user, $state) {
            
            $table_content = array();$prestations = $user->getEnseignantPrestations();
            foreach ($prestations as $key => $prestation) {
                $prestations[$key] = new Prestation($prestation["idprestation"]);
            }
            if ($state == "comming") {
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
                        "Jury" => $prestation->idjury->name,
                        "Date" => $prestation->date_prestation
                    );
                }
            
                $this->renderComponent("table", ["header"=>$table_header, "content"=>$table_content]);

            } else if ($state == "wait_notation") {
                print("Même page que Historique pour le moment car la gestions des notes n'est pas encore codé");
                $prestations = array_filter($prestations, function($prestation) {
                    return strtotime($prestation->date_prestation) < strtotime(date("Y-m-d H:i:s"));
                });

                $table_header = array("Evenement", "Eleve", "Salle", "Jury", "Date","Note");

                $table_content = array();
                foreach ($prestations as &$prestation) {
                    $table_content[$prestation->idprestation] = array(
                        "Evenement" => $prestation->idevent->entitled_event,
                        "Eleve" => $prestation->idstudent->idinternaluser->nom." ".$prestation->idstudent->idinternaluser->prenom,
                        "Salle" => $prestation->idjury->idclassroom->name_classroom,
                        "Jury" => $prestation->idjury->name,
                        "Date" => $prestation->date_prestation,
                        "Note" => "TODO"
                    );
                }
            
                $this->renderComponent("table", ["header"=>$table_header, "content"=>$table_content]);
            } else if ($state == "history") {
                print("Même page que Notations pour le moment car la gestions des notes n'est pas encore codé");
                $prestations = array_filter($prestations, function($prestation) {
                    return strtotime($prestation->date_prestation) < strtotime(date("Y-m-d H:i:s"));
                });

                $table_header = array("Evenement", "Eleve", "Salle", "Jury", "Date","Note");

                $table_content = array();
                foreach ($prestations as &$prestation) {
                    $table_content[$prestation->idprestation] = array(
                        "Evenement" => $prestation->idevent->entitled_event,
                        "Eleve" => $prestation->idstudent->idinternaluser->nom." ".$prestation->idstudent->idinternaluser->prenom,
                        "Salle" => $prestation->idjury->idclassroom->name_classroom,
                        "Jury" => $prestation->idjury->name,
                        "Date" => $prestation->date_prestation,
                        "Note" => "TODO"
                    );
                }
            
                $this->renderComponent("table", ["header"=>$table_header, "content"=>$table_content]);
            }

        }
















        
        public function view() {
            try {
                $b = new Classroom(parameters()["id"]);
                $this->render("view", $b);
            } catch (Exception $e) {
                (new SiteController())->render("index");
                // $this->render("error");
            }
        }

        public function add() {
            if (isset(parameters()["idindividualevaluation"])) {
                $prestation = new Prestation();
                $prestation->idcompose = parameters()["idcompose"];
                $prestation->idevaluationcriteria = parameters()["idevaluationcriteria"];
                $prestation->idprestation = parameters()["idprestation"];
                $prestation->individual_comment = parameters()["individual_comment"];
                $prestation->individual_note = parameters()["individual_note"];
                $prestation->insert();
                $this->render("index", Classroom::findAll());
            } else {
                $prestation = new Prestation(parameters()["id"]);
                $event = Evaluationcriteria::findOne(["idevent"=>$prestation->idprestation]);
                $this->render("add", array('prestation'=>$prestation, 'evalcritere'=>$event));

            }
        }

    }



