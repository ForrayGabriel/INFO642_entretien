<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<?php 
    $table_header = array("Username", "Nom", "Prenom", "Email", "Role");
    
    foreach ($data as &$user) {
        $table_content[$user->idinternaluser] = array(
            "Username" => $user->username,
            "Nom" => $user->nom,
            "Prenom" => $user->prenom,
            "Email" => $user->email,
            "Role" => $user->idrole->name_role
        );
    }

    $table_addBtn = array("text" => "Ajouter un membre", "url" => "?r=users/add");

    $table_actions = array(
        array("url" => "?r=", "desc"=>"update password", "icon"=>"updatepasswordicon.png"),
        array("url" => "?r=users/delete&id=:id", "desc"=>"delete member", "icon"=>"removeicon.png")
    );

    include 'components/table.php'; 

?>
