<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<?php 
    $table_header = array("Evenement", "Eleve", "Salle", "Jury", "Date");

    foreach ($data as &$prestation) {
        $table_content[$prestation->idprestation] = array(
            "Evenement" => $prestation->idevent->entitled_event,
            "Eleve" => $prestation->idstudent->idinternaluser->nom." ".$prestation->idstudent->idinternaluser->prenom,
            "Salle" => $prestation->idjury->idclassroom->name_classroom,
            "Jury" => $prestation->idjury->name,
            "Date" => $prestation->date_prestation
        );
    }

    include 'components/table.php'; 