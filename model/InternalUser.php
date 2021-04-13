<?php

class InternalUser extends Model {

	protected $_idinternaluser;
	protected $_nom_internaluser;
	protected $_prenom_internaluser;
  	protected $_email_internaluser;
  	protected $_password;
  	protected $_username;
 	protected $_idrole;

	public function __toString() {
		return get_class($this).": ".$this->nom_internaluser;
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


