<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<div class="container">
	<h2 id="connexion">Informations</h2>
	<table>
		<tr>
			<th>Login</th>
			<td><?php print($data["user"]->username); ?></td>
		</tr>
		<tr>
			<th>Nom</th>
			<td><?php print($data["user"]->nom); ?></td>
		</tr>
		<tr>
			<th>Prénom</th>
			<td><?php print($data["user"]->prenom); ?></td>
		</tr>
		<tr>
			<th>Mail</th>
			<td><?php print($data["user"]->email); ?></td>
		</tr>
	</table>
</div>

<?php 
	if ($data["error"]) {
		print("<div class='container password error'>"); 
	} else {
		print("<div class='container password'>"); 
	}
?>
	<h2 id="connexion">Changer de mot de passe</h2>
	<form action="?r=profil" method="post">
	<table>
		<tr>
			<th>Actuel</th>
			<td><input placeholder="Ancien mot de passe" type="password" name="old_psw" required></td>
		</tr>
		<tr>
			<th>Nouveau</th>
			<td><input placeholder="Nouveau mot de passe" type="password" name="new_psw" required></td>
		</tr>
		<tr>
			<th>Confirmer</th>
			<td><input placeholder="Confirmer votre nouveau mot de passe" type="password" name="cfm_psw" required></td>
		</tr>
	</table>
	<button type="submit">Mettre a jour</button>
	</form>
</div>