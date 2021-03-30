<!DOCTYPE html> 
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="./css/style.css"/>
	<?php echo (file_exists('./css/'.parameters()["r"])) ?>
	<?php echo (file_exists('./css/'.parameters()["r"].'.css')) ? "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/".parameters()["r"].".css\"/>" : "nothing"; ?>
</head>
<body>
	<main>
	<header>
		<h1><a href=''>La gestion des cours</a></h1>
	</header>
	<nav>
		<ul>
			<li><a href="?r=classroom">Les classes ssde cours</a></li>
		</ul>
	</nav>
	<section>	
