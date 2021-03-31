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
		<h1><a href=''>La gestion des cours</a></h1>
	</header>
	<nav>
		<ul>
			<li><a href="?r=classroom">Les classes de cours</a></li>
		</ul>
	</nav>
	<section>	
