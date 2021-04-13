<?php

echo "<table>";


echo"<tr>";
echo"<th scope='col'>&nbsp; Id prestation &nbsp;</th>";
echo"<th scope='col'>&nbsp; Id étudiant &nbsp;</th>";
echo"<th scope='col'>&nbsp; Id jury &nbsp; </th>";
echo"<th scope='col'>Id event</th>";
echo"<th scope='col'>Début</th>";
echo"<th scope='col'>Fin</th>";
echo"<th scope='col'>Observation</th>";
echo "</tr>";
echo"<br>";




foreach($data["prestation"] as $prestation){
    if($data["internaluser"]->idinternaluser){
        echo"<tr>";
        echo"<th scope='row'>".$prestation->idprestation."</th>";
        echo"<td>&emsp;&ensp;&ensp;".$prestation->idstudent."</td>";
        echo"<td>&emsp;".$prestation->idjury."</td>";
        echo"<td>&emsp;".$prestation->idevent."</td>";
        echo"<td>".$prestation->start_time."</td>";
        echo"<td>".$prestation->end_time."</td>";
        echo"<td>".$prestation->comment_jury."</td>";
        echo"<td><a href='?r=prestation/add&id=".$prestation->idprestation."'><button type='button'>Noter</button></a></td>";
        echo "</tr>";
        echo"<br>";
    }
}
echo "</table>";

///colonnes notes : critère / bareme / note / appreciation  



?>

