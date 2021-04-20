<br>
<center>
	<h1> Gestion des demande de contact </h1>

	<?php
	if(!empty($data['user_contact'])){
		?>
		
		<table class="global_table">
			<thead>
				<tr class="global_head_line">
					<th class="global_top_line">Object du contact :</th>
					<th class="global_top_line">Contacter par :</th>
					<th class="global_top_line">Type de l'erreur :</th>
					<th class="global_top_line">Date de contact :</th>
					<th class="global_top_line">Voir la demande de contact</th>
				</tr>
			</thead>

				<?php
				foreach($data['user_contact'] as $contact){
					if(!($contact->is_close)){
						echo "<tbody>";
						echo "<tr class='global_main_line'>";
						echo "<td class='global_top_line'>" . $contact->title_contact . "</td>";
						foreach($data['internaluser'] as $user){
							if($contact->iduser_requestor == $user->idinternaluser){
								echo "<td class='global_top_line'>" . $user->nom_internaluser . " " . $user->prenom_internaluser. "</td>";
							}
						}
						echo "<td class='global_top_line'>" . $contact->type_demande . "</td>";
						echo "<td class='global_top_line'>" . $contact->date_contact . "</td>";
						echo "<td class='global_top_line'> <a href='?r=contact/admin_view&id=".$contact->idusercontact."'><buttontype='button'> Répondre </button></a></td>";
						echo "</tr>";
						echo "</tbody>";
					}
				}
			}else{
				echo "<p> Aucune demande de contact en cours !</p>";
			}
			?>

		</table>
</center>