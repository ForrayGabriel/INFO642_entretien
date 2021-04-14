
<center>
<br>
<h1> Mes résultats </h1>


<table class="global_table">
	<thead>
		<tr class="global_head_line">
			<th class="global_top_line">Type de soutenance </th>
			<th class="global_top_line">Date de la soutenance</th>
			<th class="global_top_line">Jury </th>
			<th class="global_top_line">Commentaire du jury </th>
			<th class="global_top_line">Note finale </th>
			<th class="global_top_line">En savoir plus </th>
		</tr>
	</thead>

	<?php 
	$key = array();

	foreach($data['events'] as $event){
		foreach($data['results'] as $result){
			if($result->idevent == $event[0]->idevent and !in_array($result,$key)){
				array_push($key,$result);
				echo "<tbody>";
				echo "<tr class='global_main_line'>";
				echo "<td class='global_top_line'>" .$event[0]->entitled_event . "</td>";
				echo "<td class='global_top_line'>". $result->date_prestation."</td>";
				foreach($data['jury'] as $jury){
					if($jury[0]->idjury == $result->idjury){
						echo "<td class='global_top_line'>". $jury[0]->name_jury."</td>";
					}
				}
				echo "<td class='global_top_line'>". $result->comment_jury ."</td>";
				echo "<td class='global_top_line'> TODO </td>";
				echo "<td class='global_top_line'> <a class='presta' href='?r=result/view&id=". $result->idprestation ."'> En savoir plus</a> </td>";
				echo "</tr>";
				echo "</tbody>";
			}
		}
	}

?>
</table>
</center>



