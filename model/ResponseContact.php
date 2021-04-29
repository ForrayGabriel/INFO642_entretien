<?php

class ResponseContact extends Model {
	
	protected $_idresponsecontact;
	protected $_idusercontact;
	protected $_idinternaluser_requestor;
	protected $_idinternaluser_receiver;
	protected $_title_response;
	protected $_text_response;
	protected $_date_response;

 	//TODO
	public function __toString() {
		return get_class($this).": ".$this->title_contact;
	}
}


