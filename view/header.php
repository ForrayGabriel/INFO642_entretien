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
					<?php if (isset($_SESSION['user'])){?>
					
					<li><a href="?r=profil/logout">Logout</a></li>
				
					
					
					<?php } else{?>
					<li><a href="?r=login">Login</a></li>
					
					<?php } ?>
					<li><a href="?r=site/presentation">Présentation</a></li>
				</ul>
			</div>
		</div>
	</header>

	<nav class="background">
		<ul>
			<li><a href="?r=classroom">Les classes de cours</a></li>
			<li><a href="?r=event">Les events</a></li>
			<li><a href="?r=evaluationcriteria">Les différents critères d'évaluation</a></li>
		</ul>
	</nav>
	<section class="background">	
