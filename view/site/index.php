<link rel="stylesheet" type="text/css" href="./css/presentation.css"/>

<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<div class="texte_bienvenue" id="presentation-container">
	<h1>Bienvenue sur le site de gestion d'entretien, celui-ci permet chaque année de gérer les entretiens qui sont organisés au sein de Polytech Annecy-Chambéry.</h1><br>
	<h1>On y retrouve par exemple les entretiens de recrutements (PEIP ou filière ingénieurs), les évaluations de compétences des étudiants dans le cadre des APP, les évaluations de projets (projet usage, recherche & développement,...) ou encore les évaluations de stage (stage ingénieur, ...)</h1><br>
	
	<h1>Vous trouverez tous les renseignements nécessaires sur la page de présentation.<br>Pour tout problème technique, veuillez contacter l'administrateur.</h1>

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

