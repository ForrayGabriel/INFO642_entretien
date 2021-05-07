<?php


class Model {

	public function __construct($id=null) {
		$class = get_class($this);
		$table = strtolower($class);
		if ($id != null) {
			$st = db()->prepare("select * from $table where id$table=:id");
			$st->bindValue(":id", $id);
			$st->execute();
			if ($st->rowCount() != 1) {
				throw new Exception("Not in table: ".$table." id: ".$id );
			} else {
				$row = $st->fetch(PDO::FETCH_ASSOC);
				$classes = glob('model/*');
				$classes_update = array();
				foreach($classes as &$value) {
					$value = substr($value,6);
					$value = substr($value,0,-4);
					$classes_update[strtolower($value)] = $value;
				}
				foreach($row as $field => $value) {
					if (substr($field, 0,2) == "id") {
						$linkedField = substr($field, 2);
						if (strpos($linkedField, '_') !== false)
							$linkedField = substr($linkedField, 0, strpos($linkedField, "_"));
							
						$linkedClass = $classes_update[$linkedField];
						if ($linkedClass != get_class($this)) {
							$this->$field = new $linkedClass($value);
						}
						else
							$this->$field = $value;
					} else {
						$this->$field = $value;
					}
				}
			}
		}
	}

	public function insert(){
		$fields = [];
		$values = [];
		foreach($this as $field=>$value) {
			if (strtolower('_id'.get_class($this)) != $field && $this->$field !== null) {
				$fields[] = substr($field, 1);
				$values[] = $value;
			}
		}

		try{		
			$request = db()->prepare("INSERT INTO " . strtolower(get_class($this)) . "(" . implode(',',$fields) .") VALUES (\"" . implode('","',$values) . "\")");
			$request->execute();
			return db()->lastInsertId();

		} catch(PDOException $e) {
  			echo $e->getMessage();
		}
	}

	public function delete(){
		$class = get_class($this);
		$table = strtolower($class);
		$primary_id = "id$table";
		try{
			$request = db()->prepare("delete from $table where id$table=:id");
			$request->bindValue(":id", $this->$primary_id, PDO::PARAM_INT);
			$request->execute();
		} catch(PDOException $e) {
  			echo $e->getMessage();
		}
	}

	public function update(){
		$fields = [];
		$values = [];
		$primary_id = "_id" . strtolower(get_class($this));
		foreach($this as $field=>$value) {
			if ($field != $primary_id) {
				$fields[] = substr($field, 1);
				$values[] = $value;
			}
		}

		try{		
			$request = db()->prepare("UPDATE " . strtolower(get_class($this)) . "(" . implode(',',$fields) .") VALUES (\"" . implode('","',$values) . "\")");
			$request->execute();

		} catch(PDOException $e) {
  			echo $e->getMessage();
		}
	}

	public static function findAll($params = null){
		$class = get_called_class();
		$table = strtolower($class);

		$sql = "select id$table from $table";

		if($params){
			foreach($params as $attribute => $element){
				foreach($element as $field => $action){
					$sql .= " " . $attribute . " " . $field . " " . $action . "";
				}
			}
		}

		$st = db()->prepare($sql);
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$list[] = new $class($row["id".$table]);
		}
		return $list;
	}

	public static function findOne($data, $operator = null, $params = null) {
        $class = get_called_class();
        $table = strtolower(get_called_class());

        array_walk($data,
            function (&$v, $k) {
                if(is_string($v)){
                    $v = "$k = '$v'";
                }
                else{
                    $v = $k.' = '.$v;
                }
            }
        );

        if($operator == "or"){
            $res = implode(' or ', $data);
        }else{
            $res = implode(' and ', $data);
        }

        $sql = "select id$table from $table where $res";


		if($params){
			foreach($params as $attribute => $element){
				foreach($element as $field => $action){
					$sql .= " " . $attribute . " " . $field . " " . $action . "";
				}
			}
		}
        $st = db()->prepare($sql);
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
		else {
			throw new Exception("Unknown variable: ".$fieldName." in ".get_class($this));
		}
	}


	public function __set($fieldName, $value) {
		$varName = "_".$fieldName;
		if ($value !== null) {
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
			} else {
				throw 	new Exception("Unknown variable: ".$fieldName. " in ".get_class($this));
			}
		}
	}

	// à surcharger
	public function __toString() {
		return get_class($this).": ".$this->name;
	}




}



