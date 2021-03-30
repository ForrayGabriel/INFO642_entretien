<?php

class EvaluationCriteria extends Model {

	protected $_idevaluationcriteria;
	protected $_idevent;
	protected $_description_criteria;
	protected $_scale_criteria;	

	public function __toString() {
		return get_class($this).": ".$this->description_criteria." ".$this->scale_criteria ;
	}
}