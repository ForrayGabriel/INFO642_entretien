<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<?php 
    extract($data);
    $roles = array(1=>"Eleve", 2=>"Enseignant", 3=>"Admin");
    $table_header = array("Evenement", "Eleve", "Salle", "Jury");
    
    foreach ($data as &$prestation) {
        $table_content[$prestation['idprestation']] = array(
            "Evenement" => $prestation['entitled_event'],
            "Eleve" => $prestation['nom']." ". $prestation['prenom'],
            "Salle" => $prestation['nom']." ". $prestation['name_classroom'],
            "Jury" => $prestation['name_jury']
        );
    }

    $table_actions = array(
        array("url" => "?r=", "desc"=>"noter la prestation", "icon"=>"evaluationicon.png"));

    include 'components/table.php'; 