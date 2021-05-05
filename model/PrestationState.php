<?php

class PrestationState extends Model {

	protected $_idnotationstate;
	protected $_state;
		

	public function __toString() {
		return get_class($this);
	}
}