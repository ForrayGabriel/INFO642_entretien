

<br><br>
<center>
<div>
	<h1> Mes résultats </h1>
	<table class="global_table">
		<thead>
			<tr class="global_head_line">
			    <th class="global_top_line">Critère</th>
			    <th class="global_top_line">Note</th>
			    <th class="global_top_line">Commentaire</th>
			</tr>
		</thead>
		<?php 
		foreach($data['individual_evaluation'] as $indiv_eval){
			echo "<tbody>";
			echo "<tr class='global_main_line'>";
			foreach($data['criteres'] as $critere){
				if($indiv_eval->idevaluationcriteria == $critere->idevaluationcriteria){
					echo "<td class='global_top_line'>" . $critere->description_criteria ."</td>";
				}
			}
			echo "<td class='global_top_line'>" . $indiv_eval->individual_note ."</td>";
			echo "<td class='global_top_line'>" . $indiv_eval->individual_comment."</td>";

			echo "</tr>";
			echo "</tbody>";

		}

		?>

	</table> 

</div>
</center>

