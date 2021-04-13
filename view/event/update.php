<h2> Modifier un évenement </h2>


<form action='?r=event/update_event' method='post'>
	<input type="hidden" name="idevent" value=<?php echo $data['object']->idevent; ?> >
	<p>
		Titre
		<input value=<?php echo $data['object']->entitled_event; ?> placeholder= <?php echo $data['object']->entitled_event; ?> name='entitled_event'/>
	</p>
	<p>
		Description
		<input value=<?php echo $data['object']->description_event; ?> placeholder= <?php echo $data['object']->description_event; ?> name='description_event'/>
	</p>

	<p>
		<label for="idevent_creator">Choix de l'enseignant responsable de l'évenement :</label>

		<select name="idevent_creator" id="idevent_creator">
		<?php
			foreach($data['internaluser'] as $user){
				if($data['role_ban'] != $user->idrole){
					if($user != $data['actual_creator'] ){
						echo "<option value=' " . $user->idinternaluser . " '>".  $user->nom_internaluser  . " " .  $user->prenom_internaluser  ."</option>";
					}else{
						echo "<option selected value=' " . $user->idinternaluser . " '>".  $user->nom_internaluser  . " " .  $user->prenom_internaluser  ."</option>";
					}
				}
			}

		?>
		</select>
	</p>

	<p>
		Date début
		<input type="date" name="start_date" min="2018-01-01" max="2018-12-31" value=<?php echo $data['object']->start_date; ?> >
	</p>
	<p>
		Date de fin
		<input type="date" name="end_date" min="2018-01-01" max="2018-12-31" value=<?php echo $data['object']->end_date; ?>>
	</p>
	<p>
		<input type='submit' value='Modifier'/>
	</p>

</form>
