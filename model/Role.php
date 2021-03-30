<?php

class Role extends Model {

	protected $_idrole;
	protected $_name_role;


	public function __toString() {
		return get_class($this).": ".$this->name_role;
	}
}


