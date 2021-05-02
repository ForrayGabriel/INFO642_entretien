<?php

class Event extends Model {

	protected $_idevent;
	protected $_entitled_event;
	protected $_description_event;
	protected $_idevent_creator;
	protected $_start_date;
	protected $_end_date;

	public function __toString() {
		return get_class($this).": ".$this->entitled_event;
	}
}


