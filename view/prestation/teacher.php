<link rel="stylesheet" type="text/css" href="././css/student_teacher.css"/>
<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<p class="phrase">Bienvenue
<?php 
print_r($_SESSION["user"]["prenom"]." ");
print_r($_SESSION["user"]["nom"]); 
?>
</p>

<?php 
    $table_title = "Évènements à venir";
    $table_header = array("Evenement","Date", "Jury", "Commentaire jury", "Salle");

    foreach ($data as &$prestation) {
        $table_content[$prestation->idprestation] = array(
            "Evenement" => $prestation->idevent->entitled_event,
            "Date" => $prestation->date_prestation,
            "Jury" => $prestation->idjury->name,
            "Commentaire jury" => $prestation->comment_jury,
            "Salle" => $prestation->idjury->idclassroom->name_classroom,
            
            
        );
    }

    include 'components/table.php'; 