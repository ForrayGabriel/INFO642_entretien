<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<div class="container">
    <input type="text" id="searchBox" placeholder="Search for names..">

    <table id="users">
    <tr class="header">
        <th>Username</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Role</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php 

    $roles = array(1=>"Eleve", 2=>"Enseignant", 3=>"Admin");

    foreach ($data as &$user) {
        print("<tr>");
        print("<td>$user->username</td>");
        print("<td>$user->nom</td>");
        print("<td>$user->prenom</td>");
        print("<td>$user->email</td>");
        print("<td>".$roles[$user->idrole]."</td>");
        print("<td class='no-padding'><a title='update password' href=''><img src='./images/updatepasswordicon.png'></a></td>");
        print("<td class='no-padding'><a title='delete member' href='.?r=users/delete&id=$user->idinternaluser'><img src='./images/removeicon.png'></a></td>");
        print("</tr>");
    }

    ?>
    
    </table>
</div>
