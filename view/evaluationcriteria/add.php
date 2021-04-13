<h2>Ajouter un critère d'évaluation</h2>

<form action='?r=evaluationcriteria/add' method='post'>
	<p>
		<label>Label event</label>
		<select name='idevent'>
			<option value="">-</option>
			<?php
			foreach ($data as $event) {
				echo "<option value='".$event->idevent."'>".$entitled_event."</option>";
			}
			 ?>

		</select>
	</p>
	

	<p>
		<label>Description du critère</label>
		<textarea name='description_criteria'></textarea>
	</p>
	<p>
		<label>Notation (ex: {0:20})</label>
		<input name='scale_criteria'/>
	</p>
	<p>
		<input type='submit' value='Ajouter'/>
	</p>
</form>
