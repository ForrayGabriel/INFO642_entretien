
<h2>Liste des classes de cours</h2>

<?php
foreach($data as $classroom) {
	echo "<a href='?r=classroom/view&id=".$classroom->idclassroom."'>".$classroom->name_classroom."</a>";
}

?>
<br><br><br>
<a href='?r=classroom/add'>Ajouter une classe</a>