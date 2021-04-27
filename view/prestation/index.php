<div>
    <div class="table-title">
        <h3>Data Table</h3>
    </div>
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
    echo"<th scope='col'>Noter</th>";
    echo "</tr>";




    foreach($data["prestation"] as $prestation){
        if($data["internaluser"]->idinternaluser){
            echo"<tr>";
            echo"<td scope='row'>".$prestation->idprestation."</th>";
            echo"<td>&emsp;&ensp;&ensp;".$prestation->idstudent."</td>";
            echo"<td>&emsp;".$prestation->idjury."</td>";
            echo"<td>&emsp;".$prestation->idevent."</td>";
            echo"<td>".$prestation->start_time."</td>";
            echo"<td>".$prestation->end_time."</td>";
            echo"<td>".$prestation->comment_jury."</td>";
            echo"<td><a href='?r=prestation/add&id=".$prestation->idprestation."'><button type='button'>Noter</button></a></td>";
            echo "</tr>";
        }
    }
    echo "</table>";

// /colonnes notes : critère / bareme / note / appreciation  

    ?>

