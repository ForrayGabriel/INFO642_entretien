<?php 

class Compose extends Model {

	protected $_idcompose;
	protected $_idjury;
	protected $_idinternaluser;
	
	public function __toString() {
		return get_class($this);
	}

}




?>