<?php

echo"<form method='post' action='?r=prestation/add'>";

echo "<table>";
echo"<tr>";
echo"<th scope='col'>Critère</th>";
echo"<th scope='col'>Type note</th>";
echo"<th scope='col'>Note</th>";

echo "</tr>";


foreach($data['evalcritere'] as $critere){
    echo"<tr>";
    echo"<td>".$critere->description_criteria."</td>";
    ///print($critere->scale_criteria);
    $liste = explode(',',str_replace(['{','}'], '', $critere->scale_criteria));

    echo"<td>".implode(' - ', $liste)."</td>";
    echo"<td>";
    if(is_numeric($liste[0])){
        echo"<input name='test' type='text'>";
    }
    else{
        echo"<p>";
        echo"<label>Note </label>";
        echo"<select name='notation'>";

        foreach($liste as $note){
            echo"<option value=".$note.">".$note."</option>";

        }
        echo"</select>";
        echo"</p>";

    
    }
    echo"</td>";
    echo"</tr>";
}

echo "</table>";
echo"<input type='submit' value='Envoyer'/>";
echo"</form>";
?>