<?php

class InternalUser extends Model {

	protected $_iduser;
	protected $_name_user;
	protected $_prenom_user;
  	protected $_email_user;
 	protected $_password;
  	protected $_username;
 	protected $_idrole;

 	//TODO
	public function __toString() {
		return get_class($this).": ".$this->name_user;
	}
}


