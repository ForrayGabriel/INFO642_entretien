<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<!-- BESOIN D'UNE EQUIPE DE CSS -->


<center>
<form action="?r=group/send" method="post" enctype="multipart/form-data">
	
		<br>
		<br>

		<p>Fichier CSV : </p>

		<input type="file" name="users" />

		<br>
		<br>

		<?php 
			foreach($data['groups'] as $group){
				echo "<div>";
				echo "<input type='checkbox' name='group_id[]' value='$group->idpeoplegroup'>";
				echo "<label for='huey'>$group->title_peoplegroup</label>";
				echo "</div>";
			}

		?>

		<br>

		<input type="submit" value="Importer" />
	</p>
</form>



</center>



