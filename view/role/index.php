<h2>Liste des différents roles</h2>

<?php
foreach($data as $role) {
	echo "<a href='?r=role/view&id=".$role->idrole."'>".$role->name_role."</a>";
}

?>
<br><br><br>
<a href='?r=role/add'>Ajouter un role</a>