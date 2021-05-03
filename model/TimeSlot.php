<?php

class TimeSlot extends Model {

	protected $_idtimeslot;
	protected $_idinternaluser;
	protected $_disponibility;
  	protected $_meridiem;

	public function __toString() {
		return get_class($this).": ".$this->idtimeslot;
	}

	public static function timeslotInMonth($date) {
		$st = db()->prepare("select idtimeslot, disponibility, meridiem from timeslot where idinternaluser=:idinternaluser and meridiem between :start_date and :end_date");
		$st->bindValue(":idinternaluser", $_SESSION["user"]["idinternaluser"]);
		$st->bindValue(":start_date", $date->format("Y-m-01"));
		$st->bindValue(":end_date", $date->format("Y-m-t"));
		$st->execute();

        $list = array();
        while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$date = new DateTime($row["meridiem"]);

			$list[$date->format("d-m-Y A")] = ["idtimeslot"=>$row["idtimeslot"], "disponibility"=>$row["disponibility"]];
        }
        return $list;
	}

	public static function timeslotDisponible($start_date, $end_date) {
		$st = db()->prepare("select idtimeslot, disponibility, meridiem from timeslot where meridiem between :start_date and :end_date and disponibility = 3");
		$st->bindValue(":start_date", $start_date);
		$st->bindValue(":end_date", $end_date);
		$st->execute();

        $list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$list[] = new TimeSlot($row["idtimeslot"]);
		}
        return $list;
	}
}


