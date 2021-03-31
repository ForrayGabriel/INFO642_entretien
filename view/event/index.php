
<h2>Liste des event</h2>

<?php
foreach($data['event'] as $event) {
	print("<br>");
	print_r($event);
	print("<br>");
	echo "<a href='?r=event/view&id=".$event->idevent."'>".$event->idevent."</a>";
	print("<br>");
}

?>
<br><br><br>
<a href='?r=event/add'>Ajouter un event</a>