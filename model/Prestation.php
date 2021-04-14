<?php

class Prestation extends Model {

	protected $_idprestation;
	protected $_idstudent;
	protected $_idjury;
	protected $_idevent;
	protected $_date_prestation;
	protected $_start_time;
	protected $_end_time;
	protected $_comment_jury;	

	public function __toString() {
		return get_class($this).": ".$this->start_time." ".$this->end_time." ".$this->comment_jury ;
	}
}