<?php 

class Jury extends Model {

	protected $_idjury;
	protected $_idclassroom;
	protected $_name_jury;
	protected $_name;
	protected $_meridiem;
	
	public static function betweenDate($start_date, $end_date) {
		$st = db()->prepare("select idjury from jury where meridiem between :start_date and :end_date");
		$st->bindValue(":start_date", $start_date);
		$st->bindValue(":end_date", $end_date);
		$st->execute();

        $list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$list[] = new Jury($row["idjury"]);
		}
        return $list;
	}

}




?>