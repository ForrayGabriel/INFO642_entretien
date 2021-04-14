<link rel="stylesheet" type="text/css" href="././css/card.css"/>

<br>
<center><h1> Mes résultats </h1></center>

<?php 
	$key = array();
	foreach($data['events'] as $event){
		foreach($data['results'] as $result){
			if($result->idevent == $event[0]->idevent and !in_array($result,$key)){
				array_push($key,$result);
				echo "<div class='blog-card'>";
				echo "<div class='meta'>";
				echo "<div class='photo' style='background-image: url(https://www.univ-smb.fr/wp-content/uploads/2015/07/polytech-evaluation.jpg)'></div>";
				echo "</div>";

				echo "<div class='description'>";
				echo "<h1>" . $event[0]->entitled_event . "</h1>";
				echo "<p>" . $result->date_prestation . "</p>";
				foreach($data['jury'] as $jury){
					if($jury[0]->idjury == $result->idjury){
						echo "<h2>". $jury[0]->name_jury."</h2>";
						break;
					}
				}
				echo "<p>" . $result->comment_jury ."</p>";
				echo "<p class='read-more'>";
				echo "<a class='button_link' href='?r=result/view&id=". $result->idprestation ."'> Voir vos résultats </a>";
				echo "</p>";
				echo "</div>";
				echo "</div>";
			}
		}
	}

?>
<center>
<h1> OUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU CA #TEAMCSS </h1>

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
							break;
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




