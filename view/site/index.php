<script src="js/presentation.js"></script>


<div id="presentation-container">
	<link rel="stylesheet" type="text/css" href="././css/presentation.css"/>
	<div>
		<img id="photo" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

		<div>
			<h1 class="texte_bienvenue">Bienvenue sur le site de gestion d'entretien.<br>Vous trouverez tous les renseignements nécessaires sur la page de présentation.<br>Pour tout problème technique, veuillez contacter l'administrateur. </h1>
		</div>

	</div>
	

</div>

<?php if (isset($_SESSION['user']) && $_SESSION['user']['idrole'] == 3){?>

	<input id="btn-change" class="btn"
	type="button"
	value="Modifier">

	<input id="btn-validate" class="btn"
	type="button"
	value="Valider"
	hidden>
<?php } ?>
