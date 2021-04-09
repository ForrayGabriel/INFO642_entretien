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
				<img src="./images/logo_usmb.jpg">
			</div>
			<div class="wrapper_menu">
				<ul>
					<?php if (isset($_SESSION['user'])){?>
					<li>Logout</li>
				
					
					
					<?php } else{?>
					<li><a href="?r=login">Login</a></li>
					
					<?php } ?>
				</ul>
			</div>
		</div>
	</header>
	<section>	
