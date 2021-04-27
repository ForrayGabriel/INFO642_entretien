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





