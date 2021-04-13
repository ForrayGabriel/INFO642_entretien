

<h2><?php  ?></h2>
<p>
<?php

echo "<a href='?r=classroom/update&id=".$data->idclassroom."'>Modifier la salle</a>";
echo "<form method='post' action='?r=classroom/delete&id=".$data->idclassroom."'>";

?>
	<p>
		Nom de la salle : <?php echo $data->name_classroom; ?>
		<br>
		Batiment de la salle : <?php echo $data->building_classroom; ?>
		<br>
		Capacité de la salle : <?php echo $data->capacity_classroom; ?>
		<br>
		Description de la salle : <?php echo $data->description_classroom; ?>
	</p>
	
	<input type="submit" name="delete" value='Supprimer'>
</form>

</p>
