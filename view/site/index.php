<link rel="stylesheet" type="text/css" href="./css/presentation.css"/>

<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<div id="presentation-container">
	<h1 class="texte_bienvenue">Bienvenue sur le site de gestion d'entretien.<br>Vous trouverez tous les renseignements nécessaires sur la page de présentation.<br>Pour tout problème technique, veuillez contacter l'administrateur. </h1>
</div>
<p id="description">
Chaque année, des entretiens sont organisés au sein de Polytech Annecy-Chambéry.<br> Ils concernent :
</p>
<div>
	<ul id="liste-entretiens">
		<li>Les entretiens de recrutements (PEIP ou filière ingénieurs)</li>
		<li>Les évaluations de compétences des étudiants dans le cadre des APP</li>
		<li>Les évaluations de projets (projet usage, recherche & développement,...)</li>
		<li>Les évaluations de stage (stage ingénieur, ...)</li>
	</ul>
</div>

<?php if (isset($_SESSION['user']) && $_SESSION['user']['idrole'] == 3){?>

	<script src="js/presentation.js"></script>

	<input id="btn-change" class="btn"
	type="button"
	value="Modifier">

	<input id="btn-validate" class="btn"
	type="button"
	value="Valider"
	hidden>
<?php } ?>

