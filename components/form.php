<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">
<link rel="stylesheet" type="text/css" href="./css/form.css"/>
<script src="./js/form.js"></script>

<div class='form-container'>

<?php
    extract($data);
    print("<h1 id='title' class='text-center'>$title</h1>");
    print("<form action='' method='post' enctype='multipart/form-data'>");
    if (isset($message) && $message !== null) {
        print("<div class='form-group'>");
        print("<p class='message ".$message["type"]."'>".$message["content"]."</p>");
        print("</div>");
    }
    

    foreach ($content as $key => $value) {
        $parameters_key = str_replace("'", "" , $key);
        $parameters_key = str_replace(" ", "_" , $parameters_key);

        $formGroup = "<div class='form-group'>";
        switch ($value["type"]) {
            case "text":
            case "number":
                $formGroup .= "\n<label id=':id' for=':id'>:label</label>";
                $formGroup .= "\n<input 
                    type='".$value["type"]."' 
                    name=':id' 
                    id=':id'
                    class='form-control' 
                    :required :placeholder :value";
                $formGroup .= "\n/>";
                break;
    
            case "text-area":
                $formGroup .= "\n<label id=':id' for=':id'>:label</label>";
                $formGroup .= "\n<textarea class='form-control' :placeholder name=':id' :required style='resize: none;height: 100px;width: 100%;''></textarea>";
                break;

            case "file":
                $formGroup .= "\n<label id=':id' for=':id'>:label</label>";
                $formGroup .= "\n<input type='file' name=':id' :required/>";
                break;

            case "date":
                $formGroup .= "\n<p>".$value["title"]."</p>";
                $formGroup .= "\n<div class='input-date'>";
                $formGroup .= "\n<input class='box-input' min=' ".date("Y-m-d H:i:s")."' type='date' name=':id_start' :required :value_start>";
                $formGroup .= "\n<input class='box-input' type='date' name=':id_end' :required :value_end>";
                $formGroup .= "\n</div>";
                $formGroup = str_replace(":value_start", isset(parameters()[$parameters_key."_start"]) ? "value='".parameters()[$parameters_key."_start"]."'" : "", $formGroup);
                $formGroup = str_replace(":value_end", isset(parameters()[$parameters_key."_end"]) ? "value='".parameters()[$parameters_key."_end"]."'" : "", $formGroup);

                break;

            case "radio":
            case "checkbox":
                $formGroup .= "\n<p>:id</p>";
                foreach ($value["options"] as $opt_value => $id) {
                    $formGroup .= "\n<label>";
                    $formGroup .= "\n<input name=':id' value='$id' type='".$value["type"]."' class='input-radio' :checked>$opt_value";
                    $formGroup = str_replace(":checked", isset(parameters()[$parameters_key]) && parameters()[$parameters_key] == $id ? "checked" : "", $formGroup);
                    $formGroup .= "\n</label>";
                }
                break;

            case "select":
                $formGroup .= "\n<p>:id</p>";
                $formGroup .= "\n<select id='dropdown' name=':id' class='form-control' :required>";
                $formGroup .= "\n<option disabled selected value>".$value["desc"]."</option>";
                foreach ($value["options"] as $value => $id) {
                    $formGroup .= "\n<option value='$id' :selected>$value</option>";
                    $formGroup = str_replace(":selected", isset(parameters()[$parameters_key]) && parameters()[$parameters_key] == $id ? "selected" : "", $formGroup);
                }
                $formGroup .= "\n</select>";
                break;
        }

        $formGroup .= "\n</div>";
        $formGroup = str_replace(":label", $key, $formGroup);
        $formGroup = str_replace(":id", $parameters_key, $formGroup);
        $formGroup = str_replace(":placeholder", isset($value['placeholder']) ? "placeholder='".$value['placeholder']."'" : "", $formGroup);
        $formGroup = str_replace(":required", isset($value['!required']) ? "" : "required", $formGroup);
        if(isset(parameters()[$parameters_key])){
            $formGroup = str_replace(":value",  isset(parameters()[$parameters_key]) ? "value='".parameters()[$parameters_key]."'" : "", $formGroup);
        }else{
            $formGroup = str_replace(":value",  isset($value['value']) ? "value='".$value['value']."'" : "", $formGroup);

        }
        
        print($formGroup);
    }
    ?>
    <div class="form-group">
      <button type="submit" id="submit" class="submit-button">
        Envoyer
      </button>
    </div>
    </form>
</div>