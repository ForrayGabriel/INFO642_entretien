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
		
		<div >

			<img id="logo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/Logo_Polytech_Annecy_Chambery.svg/640px-Logo_Polytech_Annecy_Chambery.svg.png" alt="Italian Trulli">

		</div>
		<div class="sep_verticale"></div>
		<div><h1><a class='title_general' href=''>La gestion des cours</a></h1></div>
	</header>
	<nav class = "background">
		<ul>
			<li><a href="?r=classroom">Les classes de cours</a></li>
			<li><a href="?r=event">Les évènements</a></li>
			<li><a href="?r=evaluationcriteria">Les différents critères d'évaluation</a></li>
		</ul>
	</nav>
	<section class = "background">	
