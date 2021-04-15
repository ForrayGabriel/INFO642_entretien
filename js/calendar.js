document.addEventListener("DOMContentLoaded", function() {

    let colors = ["green", "orange", "red", "neutral"]; // All colors
    let colorsAccess = ["green", "red", "neutral"]; // Colors users can select or update
    let colorsSwitch = ["green", "red"] // Colors switch when users click 

    document.querySelector(".calendar .content").addEventListener("click", function(event) {
        if (event.target.className != "day") return;
        half_day = event.offsetX+event.offsetY < 100 ? "AM" : "PM";
        focus_item = event.path[1].children[half_day == "AM" ? 1 : 2]
        
        actual_color = focus_item.classList[1]
        if (colorsAccess.includes(actual_color)) {
            index_nextColor = parseInt(Object.keys(colorsAccess).find(key => colorsAccess[key] === actual_color))+1
            console.log(index_nextColor+1)
            next_color = colorsSwitch[index_nextColor%colorsSwitch.length];
            console.log(next_color)
            event.path[1].children[half_day == "AM" ? 1 : 2].classList.remove(...colors);
            event.path[1].children[half_day == "AM" ? 1 : 2].classList.add(next_color);
        } else {
            alert("Tu as déja été affecté, contact l'admin si tu n'es pas disponible")
        }
     });
});

