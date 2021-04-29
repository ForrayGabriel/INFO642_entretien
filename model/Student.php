<?php

class Student extends Model {

	protected $_idstudent;
	protected $_num_INE;
	protected $_num_student;
  	protected $_idinternaluser;

 	//TODO
	public function __toString() {
		return get_class($this).": ".$this->num_student;
	}
}


