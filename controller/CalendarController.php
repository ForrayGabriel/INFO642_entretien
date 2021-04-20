<?php

class CalendarController extends Controller {

	var $rolepermissions = [1,2,3];

	public function index() {
		
		$colors = ["neutral"=>1, "red"=>2, "green"=>3, "orange"=>4];

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = json_decode(parameters()["data"], true);

			foreach($data as $date) {
				$timeslot = new TimeSlot();
				$timeslot->idinternaluser = $_SESSION["user"]["idinternaluser"];
				$timeslot->disponibility = $colors[$date["color"]];
				if ($date["meridiem"] == "AM")
					$timeslot->meridiem = $date["date"]." 00:00:00";
				else
					$timeslot->meridiem = $date["date"]." 12:00:00";
				$timeslot->insert();
			}
		}

		$actual_date = new DateTime();
		if (isset(parameters()['month']) && isset(parameters()['year']) && $actual_date->format("m-Y") != parameters()['month']."-".parameters()['year']) {
			$date = new DateTime("01-".parameters()['month']."-".parameters()['year']);
			if ($actual_date > $date)
				$date = new DateTime($date->format("t-m-Y"));
		} else {
			$date = new DateTime();
		}
		$data = TimeSlot::timeslotInMonth($date);
		$this->render("index", ["date"=>$date, "data"=>$data, "colors"=>array_flip($colors)]);
	}
    
}


