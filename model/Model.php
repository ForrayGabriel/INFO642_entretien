<?php


class Model {

	public function __construct($id=null) {
		$class = get_class($this);
		$table = strtolower($class);
		if ($id == null) {
			// throw new Exception("id can't be null");
		} else {
			$st = db()->prepare("select * from $table where id$table=:id");
			$st->bindValue(":id", $id);
			$st->execute();
			if ($st->rowCount() != 1) {
				throw new Exception("Not in table: ".$table." id: ".$id );
			} else {
				$row = $st->fetch(PDO::FETCH_ASSOC);
				foreach($row as $field => $value) {
					$this->$field = $value;
				}
			}
		}

	}

	public function insert(){
		$fields = [];
		$values = [];
		foreach($this as $field=>$value) {
			if (strtolower('_id'.get_class($this)) != $field) {
				$fields[] = substr($field, 1);
				$values[] = $value;
			}
		}

		try{		
			$request = db()->prepare("INSERT INTO " . strtolower(get_class($this)) . "(" . implode(',',$fields) .") VALUES (\"" . implode('","',$values) . "\")");
			$request->execute();
		} catch(PDOException $e) {
  			echo $e->getMessage();
		}
	}

	public function delete($id){
		try{
			$request = db()->prepare("DELETE FROM " . strtolower(get_class($this)) . " WHERE id". strtolower(get_class($this)). " = " . $id);
			$request->execute();
		} catch(PDOException $e) {
  			echo $e->getMessage();
		}
	}

	public static function findAll() {
		$class = get_called_class();
		$table = strtolower($class);
		$st = db()->prepare("select id$table from $table");
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$list[] = new $class($row["id".$table]);
		}
		return $list;
	}


	public function __get($fieldName) {
		$varName = "_".$fieldName;
		if (property_exists(get_class($this), $varName))
			return $this->$varName;
		else
			throw new Exception("Unknown variable: ".$fieldName);
	}


	public function __set($fieldName, $value) {
		$varName = "_".$fieldName;
		if ($value != null) {
			if (property_exists(get_class($this), $varName)) {
				$this->$varName = $value;
				$class = get_class($this);
				$table = strtolower($class);
				$id = "_id".$fieldName;
				if (isset($value->$id)) {
					$st = db()->prepare("update $table set id$fieldName=:val where id$table=:id");
					$id = substr($id, 1);
					$st->bindValue(":val", $value->$id);
				} else {
					$st = db()->prepare("update $table set $fieldName=:val where id$table=:id");
					$st->bindValue(":val", $value);
				}
				$id = "id".$table;
				$st->bindValue(":id", $this->$id);
				$st->execute();
			} else
				throw new Exception("Unknown variable: ".$fieldName);
		}
	}

	// à surcharger
	public function __toString() {
		return get_class($this).": ".$this->name;
	}




}



