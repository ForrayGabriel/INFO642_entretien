<h2>Liste des critères d'évaluation</h2>

<?php
foreach($data as $evaluationcriteria) {
	echo "<a href='?r=evaluationcriteria/view&id=".$evaluationcriteria->idevaluationcriteria."'>".$evaluationcriteria->description_criteria."</a>";
}

?>
<br><br><br>
<a href='?r=evaluationcriteria/add'>Ajouter un critère</a>