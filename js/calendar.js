document.addEventListener("DOMContentLoaded", function() {

    let colors = ["green", "orange", "red"];

    document.querySelector(".calendar .content").addEventListener("click", function(event) {
        if (event.target.className != "day") return;
        half_day = event.offsetX+event.offsetY < 100 ? "AM" : "PM";
        focus_item = event.path[1].children[half_day == "AM" ? 1 : 2]
        
        actual_color = focus_item.classList[1]
        next_color = colors[(Object.keys(colors).find(key => colors[key] === actual_color)+1)%colors.length];
        event.path[1].children[half_day == "AM" ? 1 : 2].classList.remove(...colors);
        event.path[1].children[half_day == "AM" ? 1 : 2].classList.add(next_color);
     });
});

