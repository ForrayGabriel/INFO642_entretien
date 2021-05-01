<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<?php 
    $table_header = array("Object", "Envoyé par ?","Envoyé pour ?", "Erreur", "Date");
    
    foreach ($data as &$contact) {
        $table_content[$contact->idusercontact] = array(
            "Object" => $contact->title_contact,
            "Qui" => $contact->idinternaluser_requestor->nom." ".$contact->idinternaluser_requestor->prenom,
            "Pour" => $contact->idinternaluser_receiver->nom." ".$contact->idinternaluser_receiver->prenom,
            "Erreur" => $contact->type_demande,
            "Date" => $contact->date_contact,
        );
    }
    

    $table_addBtn = array("text" => "Contacter quelqu'un", "url" => "?r=contact/write");

    $table_actions = array(
        array("url" => "?r=contact/view&id=:id", "desc"=>"", "icon"=>"evaluationicon.png"),
        array("url" => "?r=", "desc"=>"fermer la conversation", "icon"=>"removeicon.png"));

    include 'components/table.php'; 

?>