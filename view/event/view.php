<?php

	echo "<h1>" . $data['object']->entitled_event . "</h1>";
	echo "<p>" . $data['object']->description_event . "</p>";
	echo "<a href='?r=event/update_view&id=".$data['object']->idevent."'>Modifier l'évenement</a>";

?>


