<h2><?php  ?></h2>


<?php
echo "<a href='?r=evaluationcriteria/update&id=".$data["evaluationcriteria"]->idevaluationcriteria."'>Modifier le critère</a>";
echo "<form method='post' action='?r=evaluationcriteria/view&id=".$data["evaluationcriteria"]->idevaluationcriteria."'>";

?>
	<p>
		Description de l'event : <?php echo $data["event"]->entitled_event; ?>
		<br>
		Description du critère: <?php echo $data["evaluationcriteria"]->description_criteria; ?>
		<br>
		Notation : <?php echo $data["evaluationcriteria"]->scale_criteria; ?>
	</p>
	
	<input type="submit" name="delete" value='Supprimer'>
</form>
<p>


</p>
