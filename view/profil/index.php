<h2>Information du profil</h2>
<style>
	#modif_nom {
		width: 100%;
		padding: 50px 0;
		text-align: center;
		background-color: lightblue;
		margin-top: 20px;
		display: none;
	}
	#modif_prenom {
		width: 100%;
		padding: 50px 0;
		text-align: center;
		background-color: lightgreen;
		margin-top: 20px;
		display: none;
	}
	#modif_mail {
		width: 100%;
		padding: 50px 0;
		text-align: center;
		background-color: lightpink;
		margin-top: 20px;
		display: none;
	}
	#modif_mdp {
		width: 100%;
		padding: 50px 0;
		text-align: center;
		background-color: lightyellow;
		margin-top: 20px;
		display: none;
	}
</style>
<div>
	<p>Rôle : Etudiant</p>
	<p>Login : caullird</p>
	<p>Numéro INE : 1445D8854</p>
	<p>Numéro d'étudiant : 8985444447</p>
	<p>Nom : CAULLIREAU</p>
	<button onclick="affiche_div('modif_nom')">Modifier</button>
	<div id="modif_nom">
		<form method="post">
			<div class="container">
				<h2 id="chgtnom">Changement du prénom</h2>
				<input class="champ" type="text" placeholder="Nouveau nom" name="n1nom" required><br>
				<button type="submit">Confirmer</button>
			</div>
		</form>
	</div>
	<p>Prénom : Dorian</p>
	<button onclick="affiche_div('modif_prenom')">Modifier</button>
	<div id="modif_prenom">
		<form method="post">
			<div class="container">
				<h2 id="chgtpre">Changement du prénom</h2>
				<input class="champ" type="text" placeholder="Nouveau prénom" name="n1pre" required><br>
				<button type="submit">Confirmer</button>
			</div>
		</form>
	</div>
	<p>Adresse mail : caullireau.dorian@gmail.com</p>
	<button onclick="affiche_div('modif_mail')">Modifier</button>
	<div id="modif_mail">
		<form method="post">
			<div class="container">
				<h2 id="chgtmail">Changement de l'adresse mail</h2>
				<input class="champ" type="text" placeholder="Nouvelle adresse mail" name="n1mail" required><br>
				<input class="champ" type="text" placeholder="Nouvelle adresse mail" name="n2mail" required><br>
				<button type="submit">Confirmer</button>
			</div>
		</form>
	</div>
	<p>Mot de passe : password</p>
	<button onclick="affiche_div('modif_mdp')">Modifier</button>
	<div id="modif_mdp">
		<form method="post">
			<div class="container">
				<h2 id="chgtmdp">Changement du mot de passe</h2>
				<input class="champ" type="password" placeholder="Ancien mot de passe" name="omdp" required><br>
				<input class="champ" type="password" placeholder="Nouveau mot de passe" name="n1mdp" required><br>
				<input class="champ" type="password" placeholder="Nouveau mot de passe" name="n2mdp" required><br>
				<button type="submit">Confirmer</button>
			</div>
		</form>
	</div>
	

	<script>
		function affiche_div(nom) {
			var x = document.getElementById(nom);
			if (x.style.display === "block") {
				x.style.display = "none";
			} else {
				x.style.display = "block";
			}
		}
	</script>
</div>