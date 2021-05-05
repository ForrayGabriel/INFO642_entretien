<?php

class DisponibiliteController extends Controller {

	var $rolepermissions = [2,3];

	public function index() {
		
		$colors = ["neutral"=>1, "green"=>3, "orange"=>4];
		$access_color = ["neutral"=>1, "green"=>3];

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
			$now = false;
			$date = new DateTime("01-".parameters()['month']."-".parameters()['year']);
			if ($actual_date > $date)
				$date = new DateTime($date->format("t-m-Y"));
		} else {
			$now = true;
			$date = new DateTime();
		}
		$data = TimeSlot::timeslotInMonth($date);
		$this->renderComponent("calendar", ["date"=>$date, "data"=>$data, "accessColors"=>array_flip($access_color), "colors"=>array_flip($colors), "now"=>$now]);
	}
    
}


