document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("btn-change").addEventListener("click", function() {
        let html = document.getElementById("presentation-container").innerHTML

        html = html.replace(/&/g, '&amp');
        html = html.replace(/</g, '&lt');
        html = html.replace(/>/g, '&gt');

        document.getElementById("presentation-container").innerHTML = html;
        document.getElementById("presentation-container").contentEditable='true';
        document.getElementById("presentation-container").designMode='on';

        document.getElementById("btn-change").setAttribute("hidden", "true");
        document.getElementById("btn-validate").removeAttribute("hidden"); 

     });
     document.getElementById("btn-validate").addEventListener("click", function() {
        let html = document.getElementById("presentation-container").innerHTML

        html = html.replace(/&amp/g, '&');
        html = html.replace(/&lt/g, '<');
        html = html.replace(/&gt/g, '>');
        html = html.replace(/;/g, '');

        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", ".?r=site/update_presentation", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("presentation="+ html); 

        document.getElementById("presentation-container").innerHTML = html;
        document.getElementById("presentation-container").contentEditable='false';
        document.getElementById("presentation-container").designMode='off';

        alert("présentation mise à jour.")
        document.getElementById("btn-validate").setAttribute("hidden", "true");
        document.getElementById("btn-change").removeAttribute("hidden"); 
    });
    
});

