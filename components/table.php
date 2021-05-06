<link rel="stylesheet" type="text/css" href="./css/table.css"/>
<script src="./js/table.js"></script>

<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<?php 

extract($data);
print("<div class='table-container'>");
if (isset($table_title)) print("<h1>$table_title</h1>");
print("<div id='headerBox'>");
if (isset($addBtn)) {
    print("<a href='".$addBtn['url']."' id='addButton'>".$addBtn['text']."</a>");
}
print("<input type='text' id='searchBox' placeholder='Rechercher dans le tableau'>");
print("</div>");

print("<table id='table'>");
print("<tr class='table-header'>");
foreach ($header as &$header_name) {
    print("<th>$header_name</th>");
}
if (isset($actions)) {
    print("<th colspan='".count($actions)."'>Actions</th>");
}
print("</tr>");
if (count($content) > 0) {
    foreach ($content as $id => $row) {
        if (isset($rowLink)) {
            print("<tr onclick=\"document.location = '$rowLink&id=$id';\">");
        } else {
            print("<tr>");
        }
        foreach($row as $content) {
            print("<td>$content</td>");
        }
        if (isset($actions)) {
            foreach($actions as &$action) {
                print("<td class='no-padding'><a title='".$action["desc"]."' href='". str_replace(":id", $id, $action["url"]) ."'><img src='./images/".$action["icon"]."'></a></td>");
            }
        }
        print("</tr>");
    }
} else {
    $colspan = count($header);
    if (isset($actions)) $colspan++;
    print("<tr>");
    print("<td colspan=\"".$colspan."\">".(isset($no_data) ? $no_data : "Aucune donnée disponible")."</td>");
    print("</tr>");
}

?>

</table>

</div>