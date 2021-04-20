<link rel="stylesheet" type="text/css" href="./././css/event.css">
<body>
	<div class="bouton_4">
		<img class="img_plus" src="https://image.flaticon.com/icons/png/512/32/32339.png"/>
		<a class="texteduboutton_4" href='?r=event/add_view'>Ajouter un évènement</a>
	</div>

	<table class="table-fill">
		<thead>
			<tr>
				<th class="text-left">Liste des Évènements </th>
				
			</tr>
		</thead>
		<tbody class="table-hover">
				<?php
				foreach($data['event'] as $event) {
					echo "<tr>
							<td><a href='?r=event/view&id=".$event->idevent."'>".$event->entitled_event."</a>
							</td>
						</tr>";
					echo "<br>";
				}
				?>	
		</tbody>
	</table>