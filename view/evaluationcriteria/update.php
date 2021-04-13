<h2>Ajouter un critère d'évaluation</h2>

<form action='?r=evaluationcriteria/add' method='post'>
	<p>
		<label>Label event</label>
		<select name='idevent'>

			<option value="">-</option>
			<?php
			foreach ($data["event"] as $event) {
				$selected = "";
				echo $event->idevent;
				echo $data["evaluationcriteria"]->idevent;
				if($event->idevent == $data["evaluationcriteria"]->idevent){
					$selected = " selected";
				}
				echo "<option value='".$event->idevent."'".$selected.">".$event->entitled_event."</option>";
			}
			 ?>

		</select>
	</p>
	

	<p>
		<label>Description du critère</label>
		<textarea name='description_criteria'><?php echo $data["evaluationcriteria"]->description_criteria; ?></textarea>
	</p>
	<p>
		<label>Notation (ex: {0:20})</label>
		<input name='scale_criteria' <?php echo 'value="'.$data["evaluationcriteria"]->scale_criteria.'"' ?>/>
	</p>
	<p>
		<input type='submit' value='Modifier'/>
	</p>
</form>
