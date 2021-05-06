<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<link rel="stylesheet" type="text/css" href="././css/chatbox.css"/>
<link rel="stylesheet" type="text/css" href="././css/form.css"/>
<script src="././js/form.js"></script>

<center>
<br>
<h1> Suivre la conversation </h1>
<br>


<?php
if($data['contact']->idinternaluser_requestor->idinternaluser == get_id()){
	// REQUESTOR
	echo "<div class='container'>";
	echo "<img src='https://latelierduformateur.fr/wp-content/uploads/2018/03/avatar-1606916_960_720.png' alt='Avatar'>";
	echo "<p><b>De " . $data['contact']->idinternaluser_requestor->nom . " " . $data['contact']->idinternaluser_requestor->prenom ."  : ". $data['contact']->title_contact ."  </b> </br></br> ". $data['contact']->description_contact ."</p>";
	echo "<span class='time-right'>". date_format(date_create($data['contact']->date_contact),'d-m-Y H:i:s') ."</span>";
	echo "</div>";
}else{
	//RECEIVER
	echo "<div class='container darker'>";
	echo "<img src='http://judowormhout.ovh/wp-content/uploads/2016/06/avatar7.png' alt='Avatar' class='right'>";
	echo "<p><b>De " . $data['contact']->idinternaluser_requestor->nom . " " . $data['contact']->idinternaluser_requestor->prenom ."  : ". $data['contact']->title_contact ."  </b> </br></br> ". $data['contact']->description_contact ."</p>";
	echo "<span class='time-left'>". date_format(date_create($data['contact']->date_contact),'d-m-Y H:i:s') ."</span>";
	echo "</div>";
}



foreach($data['response'] as $response){
	if($response->idinternaluser_requestor->idinternaluser == get_id()){
		// REQUESTOR
		echo "<div class='container'>";
		echo "<img src='https://latelierduformateur.fr/wp-content/uploads/2018/03/avatar-1606916_960_720.png' alt='Avatar'>";
		echo "<p><b>De " . $response->idinternaluser_requestor->nom . " " . $response->idinternaluser_requestor->prenom . "  : ". $response->title_response ."  </b> </br></br> ". $response->text_response ."</p>";
		echo "<span class='time-right'>". date_format(date_create($response->date_response),'d-m-Y H:i:s') ."</span>";
		echo "</br>";
		echo "</div>";
	}else{
		// RECEIVER
		echo "<div class='container darker'>";
		echo "<img src='http://judowormhout.ovh/wp-content/uploads/2016/06/avatar7.png' alt='Avatar' class='right'>";
		echo "<p><b>De " . $response->idinternaluser_requestor->nom . " " . $response->idinternaluser_requestor->prenom . "  : ". $response->title_response ."  </b> </br></br> ". $response->text_response ."</p>";
		echo "<span class='time-left'>". date_format(date_create($response->date_response),'d-m-Y H:i:s') ."</span>";
		echo "</div>";
	}
}

?>


<h2>Repondre</h2>

</center>


<div class='form-container'>
	<form action='?r=contact/reply' method='post'>
		<input type="hidden" name="answer_iduser_requestor" value=<?php echo $data['contact']->idinternaluser_requestor->idinternaluser; ?> >	
		<input type="hidden" name="answer_iduser_receiver" value=<?php echo $data['contact']->idinternaluser_receiver->idinternaluser; ?> >
		<input type="hidden" name="answer_idcontact" value=<?php echo $data['contact']->idusercontact; ?> >

		<div class='form-group'>
			<label>Titre</label>
			<p>
				<input class='form-control' placeholder='Entrer le titre du message' name='answer_title'/>
			</p>
		</div>

		<div class='form-group'>
			<label>Contenu</label>
			<p>
				<textarea class='form-control' placeholder='Entrer le contenu du message' name='answer_text' style="resize: none;height: 100px;width: 100%;"></textarea>
			</p>
		</div>


		<div class="form-group">
	      <button type="submit" id="submit" class="submit-button">
	        Envoyer
	      </button>
	    </div>
	</form>
</div>




