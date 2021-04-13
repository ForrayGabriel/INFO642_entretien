<div>
	<h3>Modification du mot de passe</h3>
	<?php print_r($data); ?>
</div>
<div>
	<form action=".?r=profil/update_mdp_tmp" method="post">
		<?php if ($data == 'error') { ?>
			<div id="error_login">
				<h3>Erreur lors de la connexion</h3>
			</div>
		<?php } ?>
		<br><br><br>
		<div class="container">
			<h2 id="chgtmdp">Changement du mot de passe</h2>
			<input class="champ" type="password" placeholder="Ancien mot de passe" name="last_psw" required><br>
			<input class="champ" type="password" placeholder="Nouveau mot de passe" name="new_psw" required><br>
			<input class="champ" type="password" placeholder="Nouveau mot de passe" name="new_psw2" required><br>
			<button type="submit">Confirmer</button>
		</div>

	</form>
</div>