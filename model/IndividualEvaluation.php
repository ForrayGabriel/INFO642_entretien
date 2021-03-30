<?php

class IndividualEvaluation extends Model {

	protected $_idindividualevaluation;
	protected $_idprestation;
	protected $_idevaluation_criteria;
	protected $_idcompose;	
	protected $_individual_note;
	protected $_individual_comment;

	public function __toString() {
		return get_class($this).": ".$this->individual_note." ".$this->individual_comment ;
	}
}


