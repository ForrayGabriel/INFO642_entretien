<?php 
  extract($data);
  $calendar_date = new DateTime($date->format("01-m-Y"));
  $day_before_month = $calendar_date->format("w");
  if ($day_before_month == 0) $day_before_month = 7;
?>
<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">
<h1>Veuillez indiquer vos disponibilités</h1>
<link rel="stylesheet" type="text/css" href="./css/calendar.css"/>
<script src="./js/calendar.js"></script>
<div class="calendar">
    <script>let colors = <?php echo json_encode($accessColors); ?></script>
  <div class="header">
    <?php
      $calendar_date->modify('-1 month');
      $last = ".?r=disponibilite&month={$calendar_date->format("m")}&year={$calendar_date->format("Y")}";
      $calendar_date->modify('+2 month');
      $next = ".?r=disponibilite&month={$calendar_date->format("m")}&year={$calendar_date->format("Y")}";
      $calendar_date->modify('-1 month');

      echo "<a href='".$last."' class='change-month'><</a>";
      echo "<div class='month'>".$calendar_date->format("F Y")."</div>";
      echo "<a href='".$next."' class='change-month'>></a>";
    ?>
  </div>
  
  <div class="content">
    <?php

    echo "<div class='item nothing'></div>";

    // Line of day
    foreach (["L", "M", "M", "J", "V", "S", "D"] as &$day_name) {
      echo "<div class='item day_name'>{$day_name}</div>";
    }

    // If the month doesn't start with Monday, we display the week number of the line.
    if ($calendar_date->format("w") != 1)
      echo "<div class='item week_number'>{$calendar_date->format("W")}</div>";

    // Items to align day items in a month
    for ($i = 1; $i < $day_before_month; $i++) {
      echo "<div class='item nothing'></div>";
    }

    // Display past items day
    for ($i = 1; $i <= $date->format("j")-1; $i++) {
      if ($calendar_date->format("w") == 1)
        echo "<div class='item week_number'>{$calendar_date->format("W")}</div>";

      echo "<div class='item inactive'>";
      echo "<div class='day'>{$i}</div>";

      echo "<div class='half_day neutral'></div>";
      echo "<div class='half_day neutral'></div>";

      echo "</div>";
      $calendar_date->modify('+1 day');
    }

    for ($i = $date->format("j"); $i <= $date->format("t"); $i++) {
      if ($calendar_date->format("w") == 1)
      echo "<div class='item week_number'>{$calendar_date->format("W")}</div>";
      
      if ($now && $calendar_date->format("d-m-Y") == $date->format("d-m-Y")) {
        echo "<div class='item today'>"; 
      } else {
        echo "<div class='item' data-date='{$calendar_date->format("Y-m-d")}'>"; 
      }

      echo "<div class='day'>{$i}</div>";
      $class_AM = "neutral";
      $class_PM = "neutral";

      if (isset($data[$calendar_date->format("d-m-Y")." AM"])) {
        $class_AM = $colors[$data[$calendar_date->format("d-m-Y")." AM"]["disponibility"]];
      }
      if (isset($data[$calendar_date->format("d-m-Y")." PM"])) {
        $class_PM = $colors[$data[$calendar_date->format("d-m-Y")." PM"]["disponibility"]];
      }

      echo "<div class='half_day ".$class_AM."'></div>";
      echo "<div class='half_day ".$class_PM."'></div>";
      echo "</div>";
      $calendar_date->modify('+1 day');
    }

    $calendar_date->modify('-1 day');
    $day_after_month = 7-$calendar_date->format("w");

    if ($day_after_month == 7) $day_after_month = 0;

    for ($i = 1; $i <= $day_after_month; $i++) {
      echo "<div class='item nothing'></div>";
    }

    ?>
  </div>
  <div class="footer">
    <div class="legend">
      <div><div class="box green"></div>Disponible</div>
      <div><div class="box orange"></div>Assigné</div>
    </div>
    <div class="btns">
      <button>Annuler</button>
      <button>Valider</button>
    </div>
  </div>
</div>