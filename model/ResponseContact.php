<?php

class ResponseContact extends Model {
	
	protected $_idresponsecontact;
	protected $_iduser;
	protected $_iduser_respondent;
	protected $_iduser_contact;
	protected $_title_response;
	protected $_text_response;
	protected $_date_response;
	protected $_admin_response;
								

 	//TODO
	public function __toString() {
		return get_class($this).": ".$this->title_contact;
	}
}


