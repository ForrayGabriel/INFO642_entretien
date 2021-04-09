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
				<img src="./images/logo_polytech.png"/>
				<div class="separator"></div>
				<img src="./images/logo_usmb.jpg">
			</div>
			<div class="wrapper_menu">
				<ul>
					<?php print_r($_SESSION); ?>
					<?php if (isset($_SESSION['user']) && $_SESSION['user']['idrole'] == 1){?>
					<li><a href="?r=login">Login</a></li>
					<?php }else{?>
					<li>Logout</li>
					<li>Onglet</li>
					<li>Onglet</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</header>
	<section>	
