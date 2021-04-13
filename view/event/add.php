<h2> Ajouter un évenement </h2>


<form action='?r=event/add_event' method='post'>
	<p>
		Titre
		<input name='entitled_event'/>
	</p>
	<p>
		Description
		<input name='description_event'/>
	</p>

	<p>
		<label for="idevent_creator">Choix de l'enseignant responsable de l'évenement :</label>

		<select name="idevent_creator" id="idevent_creator">
			<option value="0">--Please choose an option--</option>
		<?php
			foreach($data['internaluser'] as $user){
				if($data['role_ban'] != $user->idrole){
					echo "<option value=' " . $user->idinternaluser . " '>".  $user->nom_internaluser  . " " .  $user->prenom_internaluser  ."</option>";
				}
			}

		?>
		</select>
	</p>

	<p>
		Date début
		<input type="date" name="start_date" value="2018-07-22" min="2018-01-01" max="2018-12-31">
	</p>
	<p>
		Date de fin
		<input type="date" name="end_date" value="2018-07-22" min="2018-01-01" max="2018-12-31">
	</p>
	<p>
		<input type='submit' value='Ajouter'/>
	</p>

</form>
