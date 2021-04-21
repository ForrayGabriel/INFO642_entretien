document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("btn_update").addEventListener("click", function() {
        let inputs = document.querySelectorAll('.info input[type = "text"]')

        inputs.forEach(input=>input.removeAttribute("disabled"))

     });
    
});

