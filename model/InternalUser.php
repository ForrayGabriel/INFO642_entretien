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
		$st = db()->prepare("select idinternaluser, idrole, password from internaluser where username=:username");
		$st->bindValue(":username", $username);
		$st->execute();
		if ($st->rowCount() == 1) {
			$row = $st->fetch(PDO::FETCH_ASSOC);
			if (password_verify($password, $row['password'])) {
				$internaluser["idinternaluser"] = $row["idinternaluser"];
				$internaluser["idrole"] = $row["idrole"];
				return $internaluser;
			}
		}
		return false;
	}
}


