<?php 
  $date = new DateTime();
  $day = $date->format("d");
  $month = isset(parameters()['month']) ? parameters()['month'] : $date->format("m");
  $year = isset(parameters()['year']) ? parameters()['year'] : $date->format("Y");
  $ddate = "01-".$month."-".$year;
  $date = new DateTime($ddate);
?>
<div class="calendar">
  <div class="header">
    <?php
      $date->modify('-1 month');
      $last = ".?r=calendar&month={$date->format("m")}&year={$date->format("Y")}";
      $date->modify('+2 month');
      $next = ".?r=calendar&month={$date->format("m")}&year={$date->format("Y")}";
      $date->modify('-1 month');

      echo "<a href='".$last."' class='change-month'><</a>";
      echo "<div class='month'>".$date->format("F Y")."</div>";
      echo "<a href='".$next."' class='change-month'>></a>";
    ?>
  </div>
  
  <div class="content">
    <div class='item nothing'></div>
    <?php
    foreach (["L", "M", "M", "J", "V", "S", "D"] as &$day_name) {
      echo "<div class='item day_name'>{$day_name}</div>";
    }


    echo "<div class='item week_number'>{$date->format("W")}</div>";

    for ($i = 1; $i <= $date->format("w")-1; $i++) {
      echo "<div class='item past'></div>";
    }

    for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN,$month,$year); $i++) {
      $date->modify('+1 day');

      if ($date->format("w") == 2)
        echo "<div class='item week_number'>{$date->format("W")}</div>";

      echo "<div class='item'>";
      echo "<div data-date='{$i}-{$month}-{$year}' class='day'>{$i}</div>";
      echo "<div class='half_day red'><p>Am</p></div>";
      echo "<div class='half_day orange'></div>";
      echo "</div>";
    }
    ?>
  </div>
  <div class="informations">informations</div>
</div>