<link rel="stylesheet" type="text/css" href="./css/panel.css"/>

<?php 
	$espaces = [
		1=>"Etudiant",
		2=>"Enseignant", 
		3=>"Administrateur"
	];
	
	$onglets = [
		1 => [
			"Entretient"=>"?r=prestation",
			"Résultats"=>".?r=prestation/resultat",
			"Contact"=>"?r=contact"
		],

		2 => [
			"Préstations"=>"?r=prestation",
			"Disponibilités"=>"?r=disponibilite",
			"Notations"=>".?r=prestation/notation",
			"Historique"=>".?r=prestation/historique",
			"Contact"=>"?r=contact"
		],

		3 => [
			"Évènements"=>"?r=event",
			"Historique"=>"?r=event/historique",
			"Salles"=>"?r=TODO",
			"Groupe" => "?r=group/import",
			"Utilisateurs" => "?r=users",
			"Contact"=>"?r=contact",
		]
	];
?>

<div class="banner">
	<img src="./images/banner.jpg">
	<?php print("<h2>Espace ".$espaces[get_role()]."</h2>");?>
</div>

<?php 
	print("<div class='logged_menu'>");
	foreach($onglets[get_role()] as $name => $href) {
		echo "<a class='onglet' href='$href'>$name</a>";
	}
	print("</div>");
?>