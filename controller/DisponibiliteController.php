<?php

class DisponibiliteController extends Controller {

	var $rolepermissions = [2,3];

	public function index() {
		
		$colors = ["neutral"=>1, "green"=>3, "orange"=>4];
		$access_color = ["neutral"=>1, "green"=>3];

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = json_decode(parameters()["data"], true);

			foreach($data as $date) {

				if ($date["meridiem"] == "AM") {
					$meridiem = $date["date"]." 08:00:00";
				} else {
					$meridiem = $date["date"]." 14:00:00";
				}

				$timeslots = TimeSlot::findOne(["meridiem"=>$meridiem, "idinternaluser"=>get_id()]);
				if (count($timeslots) == 0)
					$timeslot = new TimeSlot();
				else
					$timeslot = $timeslots[0];

				$timeslot->idinternaluser = $_SESSION["user"]["idinternaluser"];
				$timeslot->disponibility = $colors[$date["color"]];
				$timeslot->meridiem = $meridiem;

				if (count($timeslots) == 0)
					$timeslot->insert();
				else
					$timeslot->update();
				
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


