<h2>Modifier la salle</h2>

<form <?php echo "action='?r=classroom/update&id=".$data->idclassroom."'"; ?> method='post'>
	<p>
		<label>Nom de la salle</label>
		<input name='name_classroom' <?php echo 'value="'.$data->name_classroom.'"' ?>/>
	</p>
	<p>
		<label>Batiment de la salle</label>
		<input name='building_classroom' <?php echo 'value="'.$data->building_classroom.'"' ?>/>
	</p>
	<p>
		<label>Capacité de la salle</label>
		<input name='capacity_classroom' <?php echo 'value="'.$data->capacity_classroom.'"' ?>/>
	</p>
	<p>
		<label>Description de la salle</label>
		<input name='description_classroom' <?php echo 'value="'.$data->description_classroom.'"' ?>/>
	</p>
	<p>
		<input type='submit' value='Modifier'/>
	</p>
</form>
