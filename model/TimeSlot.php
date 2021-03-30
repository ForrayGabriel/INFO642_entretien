<?php

class TimeSlot extends Model {

	protected $_idtimeslot;
	protected $_date_day;
	protected $_start_time;
  	protected $_end_time;

 	//TODO
	public function __toString() {
		return get_class($this).": ".$this->idtimeslot;
	}
}


