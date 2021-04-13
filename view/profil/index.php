<link rel="stylesheet" type="text/css" href="././css/modif_profil.css"/>
<h2>Information du profil</h2>
<div id = 'large'>
	<div class = 'ssmodif'>
	<p>Rôle : Etudiant</p>
	<p>Login : caullird</p>
	<p>Numéro INE : 1445D8854</p>
	<p>Numéro d'étudiant : 8985444447</p>
	<p>Nom : CAULLIREAU</p>
	<p>Prénom : Dorian</p>
	</div>

	<div class = 'avecmodif'>
	<p class = 'one'>Adresse mail : <input type="text" name="mail" disabled></p>
	</div>

	<div class = 'avecmodif'>
	<p class = 'one'>Mot de passe : <input type="text" name="mail" disabled></p>
	</div>

	<button class = 'two' onclick="affiche_div('modif_mail')">Modifier</button>
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