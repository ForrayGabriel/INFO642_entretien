<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<?php 
    $table_header = array("Numéro de la salle", "Bâtiment","Capacité", "Description");
    
    foreach ($data as &$classroom) {
        $table_content[$classroom->idclassroom] = array(
            "Numéro de la salle" => $classroom->name_classroom,
            "Bâtiment" => $classroom->building_classroom,
            "Capacité" => $classroom->capacity_classroom,
            "Description" => $classroom->description_classroom,
        );
    }
    

    $table_addBtn = array("text" => "Ajouter", "url" => "?r=classroom/add");

    $table_actions = array(
        array("url" => "?r=classroom/view&id=:id", "desc"=>"", "icon"=>"evaluationicon.png"),
        array("url" => "?r=classroom/delete&id=:id", "desc"=>"Supprimer la salle", "icon"=>"removeicon.png"));

    include 'components/table.php'; 


