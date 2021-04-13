<?php

class UserContact extends Model {

	protected $_idusercontact;
	protected $_iduser;
	protected $_title_contact;
	protected $_description_contact;
	protected $_date_contact;
	protected $_type_demande;
	protected $_have_response;									

 	//TODO
	public function __toString() {
		return get_class($this).": ".$this->title_contact;
	}
}

