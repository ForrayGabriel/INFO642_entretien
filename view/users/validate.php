<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<div class="container">
	<div id="delete">
	<?php 
	echo "<p><h1>Etes-vous sûr de vouloir supprimer le compte de ".$data->prenom." ".$data->nom." ?</h1></p>";
	?>
	</div>

	<form action="?r=users/delete" method="post">
		<input type="text" name="id" value="<?php print($data->idinternaluser) ?>" hidden>
		
		<input id="btn-form-delete" type="submit" value="Confirmer">
		
	</form>
</div>
