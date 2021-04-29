<?php

class InternalUser extends Model {

	protected $_idinternaluser;
	protected $_nom;
	protected $_prenom;
  	protected $_email;
  	protected $_password;
  	protected $_username;
 	protected $_idrole;

	public function __toString() {
		return get_class($this).": ".$this->nom;
	}

	public function updatePassword($user) {
		if (!(isset(parameters()["old_psw"]) 
			&& isset(parameters()["new_psw"])
			&& isset(parameters()["cfm_psw"])
			&& parameters()["new_psw"] === parameters()["cfm_psw"]
			&& password_verify(parameters()["old_psw"], $user->password)
		)) return false;

		$user->password = password_hash(parameters()["new_psw"], PASSWORD_DEFAULT);
        $user->update();
		return true;
	}

	public static function attempt($username, $password) {
		$st = db()->prepare("select idinternaluser, nom, prenom, idrole, password from internaluser where username=:username");
		$st->bindValue(":username", $username);
		$st->execute();
		if ($st->rowCount() == 1) {
			$row = $st->fetch(PDO::FETCH_ASSOC);
			if (password_verify($password, $row['password'])) {
				$internaluser["idinternaluser"] = $row["idinternaluser"];
				$internaluser["idrole"] = $row["idrole"];
				$internaluser["nom"] = $row["nom"];
				$internaluser["prenom"] = $row["prenom"];
				$internaluser["username"] = $username;
				return $internaluser;
			}
		}
		return false;
	}

	public function getEnseignantPrestations() {
		$sql = "select 	idprestation from prestation p
				join compose c on p.idjury=c.idjury
				where c.idinternaluser=:idinternaluser";

		$st = db()->prepare($sql);
		$st->bindValue(":idinternaluser", 1);
		// $st->bindValue(":idinternaluser", $this->idinternaluser);
		$st->execute();
		return $st->fetchAll();;
	}
}


