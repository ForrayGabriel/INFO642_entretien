
<h2>Liste des event</h2>

<?php
foreach($data['event'] as $event) {
	echo "<a href='?r=event/view&id=".$event->idevent."'>".$event->entitled_event."</a>";
	echo "<br>";
}

?>
<br><br><br>
<a href='?r=event/add_view'>Ajouter un event</a>