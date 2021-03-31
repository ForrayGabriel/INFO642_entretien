<?php

class InternalUser extends Model {

	protected $_idinternaluser;
	protected $_nom_internaluser;
	protected $_prenom_internaluser;
  	protected $_email_internaluser;
  	protected $_username;
 	protected $_idrole;

	public function __toString() {
		return get_class($this).": ".$this->name_user;
	}


	public static function attempt($username, $password) {
		$st = db()->prepare("select idinternaluser, idrole from internaluser where username=:username and password=:password");
		$st->bindValue(":username", $username);
		$st->bindValue(":password", $password);
		$st->execute();
		if ($st->rowCount() != 1) {
			return false;
		} else {
			$row = $st->fetch(PDO::FETCH_ASSOC);
			foreach($row as $field=>$value) {
					$internaluser[$field] = $value;
			}
			return $internaluser;
		}	
	}
}


