
<h2>Liste des event</h2>

<?php
print_r($data[0]);
foreach($data['event'] as $event) {
	echo "<a href='?r=event/view&id=".$event->idevent."'>".$event->idevent."</a>";
}

?>
<br><br><br>
<a href='?r=event/add_view'>Ajouter un event</a>