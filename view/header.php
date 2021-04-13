<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="./css/style.css"/>
	<?php echo file_exists('./css/'.$css.'.css') ? "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/".$css.".css\"/>" : ""; ?>
</head>
<body>
	<main>
	<header>

		<div class="header-container">
			<div class="wrapper_menu_logo">

				<a href="https://www.polytech.univ-smb.fr/index.html">
				<img src="./images/logo_polytech.png"/></a>

				<div class="separator"></div>

				<a href="https://www.univ-smb.fr">
				<img id = "logo_usmb" src="./images/logo_usmb.jpg"></a>

			</div>
			<div class="wrapper_menu">
				<ul>
					<li><a class="onglet" href=".">Accueil</a></li>
					<li><a class="onglet" href="?r=site/presentation">Présentation</a></li>
					<?php if (isset($_SESSION['user'])){?>
						<li><a class="onglet" href="">Mon Profil</a></li>
						<li><a class="onglet" href="?r=profil/logout">Logout</a></li>
					<?php } else{?>
						<li><a class="onglet" href="?r=login">Login</a></li>
					<?php } ?>

					
				</ul>
			</div>
		</div>
	</header>
	<section class="background">
