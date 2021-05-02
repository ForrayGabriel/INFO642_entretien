<link rel="stylesheet" type="text/css" href="./css/table.css"/>
<script src="./js/table.js"></script>

<?php 

extract($data);
print("<div class='table-container'>");
print("<div id='headerBox'>");
if (isset($addBtn)) {
    print("<a href='".$addBtn['url']."' id='addButton'>".$addBtn['text']."</a>");
}
print("<input type='text' id='searchBox' placeholder='Rechercher dans le tableau'>");
print("</div>");

print("<table id='table'>");
print("<tr class='table-header'>");
foreach ($header as &$header) {
    print("<th>$header</th>");
}
if (isset($actions)) {
    print("<th colspan='".count($actions)."'>Actions</th>");
}
print("</tr>");
if (isset($content)) {
    foreach ($content as $id => $row) {
        print("<tr>");
        foreach($row as $content) {
            print("<td>$content</td>");
        }
        if (isset($actions)) {
            foreach($actions as &$action) {
                $action["url"] = str_replace(":id", $id, $action["url"]);
                print("<td class='no-padding'><a title='".$action["desc"]."' href='".$action["url"]."'><img src='./images/".$action["icon"]."'></a></td>");
            }
        }
        print("</tr>");
    }
}

?>

</table>

</div>