
<h2>Liste des event</h2>

<?php
foreach($data as $event) {
	echo "<a href='?r=event/view&id=".$event->idevent."'>".$event->idevent."</a>";
}

?>
<br><br><br>
<a href='?r=event/add'>Ajouter un event</a>