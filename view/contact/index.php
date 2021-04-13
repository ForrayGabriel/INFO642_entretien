
<h1> Gestion des demande de contact </h1>

<?php
if(!empty($data['user_contact'])){
	?>

	<div class = 'back'>
	
		<table>
			<tr>
				<th>Object du contact :</th>
				<th>Contacter par :</th>
				<th>Type de l'erreur :</th>
				<th>Date de contact :</th>
				<th>Voir la demande de contact</th>
			</tr>

			<?php
			foreach($data['user_contact'] as $contact){
				if(!($contact->is_close)){
					echo "<tr>";
					echo "<td>" . $contact->title_contact . "</td>";
					foreach($data['internaluser'] as $user){
						if($contact->iduser_requestor == $user->idinternaluser){
							echo "<td>" . $user->nom_internaluser . " " . $user->prenom_internaluser. "</td>";
						}
					}
					echo "<td>" . $contact->type_demande . "</td>";
					echo "<td>" . $contact->date_contact . "</td>";
					echo "<td> <a href='?r=contact/admin_view&id=".$contact->idusercontact."'><buttontype='button'> Répondre </button></a>";
					echo "</tr>";
				}
			}
		}else{
			echo "<p> Aucune demande de contact en cours !</p>";
		}



		?>

	</table>
</div>
