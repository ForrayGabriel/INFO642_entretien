<h1> Gestion des demande de contact </h1>

<table>
  <tr>
    <th>Object du contact :</th>
    <th>Contacter par :</th>
    <th>Type de l'erreur :</th>
    <th>Date de contact :</th>
    <th>Voir la demande de contact</th>
  </tr>
<?php

///////// MODIFIER POUR ADMINISTRATEUR OU NON 
foreach($data['user_contact'] as $contact){
	if(!($contact->is_close)){
		echo "<tr>";
		echo "<td>" . $contact->title_contact . "</td>";
		foreach($data['internaluser'] as $user){
			if($contact->iduser == $user->idinternaluser){
				echo "<td>" . $user->nom_internaluser . " " . $user->prenom_internaluser. "</td>";
			}
		}
		echo "<td>" . $contact->type_demande . "</td>";
		echo "<td>" . $contact->date_contact . "</td>";
		echo "<td> <a href='?r=contact/admin_view&id=".$contact->idusercontact."'><buttontype='button'> Répondre </button></a>";
		echo "</tr>";
	}
}


?>

</table>



