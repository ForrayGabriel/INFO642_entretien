<?php

class Availability extends Model {

	protected $_idavailability;
	protected $_iduser;
	protected $_idtimeslot;
	protected $_comment;	


	public function __toString() {
		return get_class($this).": ".$this->comment;
	}
}


