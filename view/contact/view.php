<h1> Suivre la conversation </h1>

<p> _______________________________________________ </p>

<?php
foreach($data['internaluser'] as $user){
	if($data['contact']->iduser_requestor == $user->idinternaluser){
		$display_name = $user->nom_internaluser . " " . $user->prenom_internaluser;
 	}
}

echo "<p>" . $display_name . "</p>";
echo "<p><b> Titre de la demande : " . $data['contact']->title_contact . "</b></p>";
echo "<p>" . $data['contact']->description_contact . "</p>";
echo "<p>" . $data['contact']->date_contact . "</p>";

echo "<p> _______________________________________________ </p>";

foreach($data['response'] as $response){
	if($data['contact']->idusercontact == $response->idusercontact){
		if($response->admin_response){
			echo "<p> Réponse de l'administrateur </p>";
		}else{
			echo "<p> Réponse de " . $display_name . "</p>";
		}
		echo "<p><b> Titre : " . $response->title_response . "</b></p>";
		echo "<p>" . $response->text_response . "</p>";
		echo "<p>" . $response->date_response . "</p>";
		echo "<p> _______________________________________________ </p>";
	}
}

?>

<p>Repondre</p>



