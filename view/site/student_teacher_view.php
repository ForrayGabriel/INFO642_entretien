
<link rel="stylesheet" type="text/css" href="././css/student_teacher.css"/>
<div id="photo"><img id="bande" src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80"><div class="centered">
<?php 
			if ($_SESSION['user']['idrole'] == 1) {

			echo "Espace Etudiant";
			}

			if ($_SESSION['user']['idrole'] == 2) {

			echo "Espace Enseignant";
			}

		 ?>	

</div></div>
<div id="contenu">
	<div id="bouttons">
	<div id="boutton1">
		<div class="test">
		<strong>
			<a class="link" 
				<?php 
					if ($_SESSION['user']['idrole'] == 1) {

					echo "href='.?r=site/prestation'>MES RÉSULTATS";
					}

					if ($_SESSION['user']['idrole'] == 2) {

					echo "href='.?r=site/resultats'>INDIQUER DISPONIBILITÉS";
					}

				 ?>	
			 </a>
		</strong>
	</div>
	</div>

	<div id="boutton2">
		
		<strong>
			<a class="link" 
		<?php 
			if ($_SESSION['user']['idrole'] == 1) {

			echo "href='.?r=site/contact'>CONTACTER L'ADMINISTRATEUR";
			}

			if ($_SESSION['user']['idrole'] == 2) {

			echo "ÉVALUER ÉVÈNEMENT";
			}

		 ?>	
		
		</strong>
		
	</div></div>
	<div id="entretients">
		Mes entretients
		<div id="lesentretiens">
			
		</div>
	</div>

</div>