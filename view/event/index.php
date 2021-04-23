
<h2>Liste des évenements</h2>
<div class='back'>
	<ul>
		<?php
		foreach($data['event'] as $event) {
			echo"<li>";
			echo "<a href='?r=event/view&id=".$event->idevent."'>".$event->entitled_event."</a>";
			echo"</li>";
		}
		?>
	</ul>
	<div class="ajout">
		<a href='?r=event/add_view'>Ajouter un nouvel évenement</a>
	</div>
</div>