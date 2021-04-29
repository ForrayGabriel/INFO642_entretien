<link rel="stylesheet" type="text/css" href="././css/chatbox.css"/>

<h1> Suivre la conversation </h1>



<?php
foreach($data['internaluser'] as $user){
	if($data['contact']->iduser_requestor == $user->idinternaluser){
		$display_name_requestor = $user->nom . " " . $user->prenom;
		$id_requestor = $user->idinternaluser;
 	}
 	if($data['contact']->iduser_receiver == $user->idinternaluser){
		$display_name_receiver = $user->nom . " " . $user->prenom;
		$id_receiver = $user->idinternaluser;
 	}

}
echo "<div class='container'>";
echo "<img src='https://latelierduformateur.fr/wp-content/uploads/2018/03/avatar-1606916_960_720.png' alt='Avatar'>";
echo "<p><b>De " . $display_name_requestor . "  : ". $data['contact']->title_contact ."  </b> </br></br> ". $data['contact']->description_contact ."</p>";
echo "<span class='time-right'>". $data['contact']->date_contact ."</span>";
echo "</div>";


foreach($data['response'] as $response){
	if($data['contact']->idusercontact == $response->idusercontact){
		if($response->iduser_requestor == $id_requestor){
			echo "<div class='container'>";
			echo "<img src='https://latelierduformateur.fr/wp-content/uploads/2018/03/avatar-1606916_960_720.png' alt='Avatar'>";
			echo "<p><b>De " . $display_name_requestor . "  : ". $response->title_response ."  </b> </br></br> ". $response->text_response ."</p>";
			echo "<span class='time-right'>". $response->date_response ."</span>";
			echo "</div>";
		}else{
			echo "<div class='container darker'>";
			echo "<img src='http://judowormhout.ovh/wp-content/uploads/2016/06/avatar7.png' alt='Avatar' class='right'>";
			echo "<p><b>De " . $display_name_receiver . "  : ". $response->title_response ."  </b> </br></br> ". $response->text_response ."</p>";
			echo "<span class='time-left'>". $response->date_response ."</span>";
			echo "</div>";
		}
	}
}

?>




<p>Repondre</p>

<form action='?r=contact/send' method='post'>

	<input type="hidden" name="answer_iduser_requestor" value=<?php echo $id_requestor;?> >
	<input type="hidden" name="answer_iduser_receiver" value=<?php echo $id_receiver; ?> >
	<input type="hidden" name="answer_idcontact" value=<?php echo $data['contact']->idusercontact; ?> >

	<label>Titre</label>
	<p>
		<input name='answer_title'/>
	</p>

	<label>Contenu</label>
	<p>
		<textarea name='answer_text'></textarea>
	</p>
	<p>
		<input type='submit' value='Ajouter'/>
	</p>
</form>




