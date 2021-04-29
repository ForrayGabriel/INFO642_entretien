<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<?php 
    $table_header = array("Nom", "Description");

    foreach ($data as &$event) {
        $table_content[$event->idevent] = array(
            "Nom" => $event->entitled_event,
            "Desc" => $event->description_event);
    }

    include 'components/table.php'; 