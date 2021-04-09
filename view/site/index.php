
<?php 
	if (isset($_SESSION['user'])){
		if ($_SESSION['user']['idrole'] == 1) {

			include_once "student_view.php";
	}
?>

<?php 
		if ($_SESSION['user']['idrole'] == 2) {
			include_once "teacher_view.php";
	}
?>

<?php 
		if ($_SESSION['user']['idrole'] == 3) {
			include_once "admin_view.php";
	}}
	else {?>
		<br><br><br>
		<h1 class="texte_bienvenue">Bienvenue sur le site de gestion d'entretien.<br>Vous trouverez tous les renseignements nécessaires sur la page de présentation.<br>Pour tout problème technique, veuillez contacter l'administrateur. </h1>

	<?php }
?>