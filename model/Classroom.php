<?php

class Classroom extends Model {

	protected $_idclassroom;
	protected $_name_classroom;
	protected $_building_classroom;
	protected $_capacity_classroom;	


	public function __toString() {
		return get_class($this).": ".$this->name_classroom;
	}
}


