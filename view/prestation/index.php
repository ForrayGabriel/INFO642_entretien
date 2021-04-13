<?php

print_r($_SESSION);

echo '<table>';


echo"<tr>";
echo"<td>Identifiant prestation</td>";
echo"<td>Identifiant étudiant</td>";
echo"<td>Identifiant jury</td>";
echo"<td>Identifiant évènement</td>";
echo"<td>Heure début</td>";
echo"<td>Heure fin</td>";
echo"<td>Observation</td>";
echo "<br>";

foreach($data["prestation"] as $prestation){
    if($data["internaluser"]->idinternaluser){
        echo"<tr>";
        echo"<td>".$prestation->idprestation."</td>";
        echo"<td>".$prestation->idstudent."</td>";
        echo"<td>".$prestation->idjury."</td>";
        echo"<td>".$prestation->idevent."</td>";
        echo"<td>".$prestation->start_time."</td>";
        echo"<td>".$prestation->end_time."</td>";
        echo"<td>".$prestation->comment_jury."</td>";
        echo "<br>";
    }
}
?>

