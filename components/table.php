<link rel="stylesheet" type="text/css" href="./css/table.css"/>
<script src="./js/table.js"></script>

<?php 

print("<div class='table-container'>");
if (isset($table_title)) print("<h1>$table_title</h1>");
print("<div id='headerBox'>");
if (isset($table_addBtn)) {
    print("<a href='".$table_addBtn['url']."' id='addButton'>".$table_addBtn['text']."</a>");
}
print("<input type='text' id='searchBox' placeholder='Rechercher dans le tableau'>");
print("</div>");

print("<table id='table'>");
print("<tr class='table-header'>");
foreach ($table_header as &$header) {
    print("<th>$header</th>");
}
if (isset($table_actions)) {
    print("<th colspan='".count($table_actions)."'>Actions</th>");
}
print("</tr>");
if (isset($table_content)) {
    foreach ($table_content as $id => $row) {
        print("<tr>");
        foreach($row as $content) {
            print("<td>$content</td>");
        }
        if (isset($table_actions)) {
            foreach($table_actions as $actions) {
                $actions["url"] = str_replace(":id", $id, $actions["url"]);
                print("<td class='no-padding'><a title='".$actions["desc"]."' href='".$actions["url"]."'><img src='./images/".$actions["icon"]."'></a></td>");
            }
        }
        print("</tr>");
    }
}

?>

</table>

</div>