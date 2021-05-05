<?php

class PeopleGroup extends Model {
	protected $_idpeoplegroup;
	protected $_title_peoplegroup;
	protected $_description_peoplegroup;

	public function __toString() {
		return get_class($this).": ".$this->title_peoplegroup;
	}
}