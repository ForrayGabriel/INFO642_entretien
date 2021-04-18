document.addEventListener("DOMContentLoaded", function() {
    let item_size = document.querySelector(".calendar .content .item").offsetHeight
    let btnIsEnabled = true;
    let updatedData = {}
    colors = Object.values(colors)

    function disableBtns() {
        btnIsEnabled = false;
        document.querySelectorAll(".calendar .header .change-month").forEach(btn => {
            btn.addEventListener('click', (event) => {
                alert("Tu as effectué des modifications, clique sur sauvegarder ou annuler avant de changer de mois")
                event.preventDefault();
            })
        });
    }

    document.querySelector(".calendar .content").addEventListener("click", (event) => {
        if (event.target.className != "day") return;
        if (event.path[1].classList[1] == "today") return;
        if (event.path[1].classList[1] == "inactive") return;
        if (btnIsEnabled) disableBtns();

        half_day = event.offsetX+event.offsetY < item_size ? "AM" : "PM";
        focus_item = event.path[1].children[half_day == "AM" ? 1 : 2]
        actual_color = focus_item.classList[1]

        if (colors.includes(actual_color)) {
            index_nextColor = parseInt(Object.keys(colors).find(key => colors[key] === actual_color))+1
            next_color = colors[index_nextColor%colors.length];
            event.path[1].children[half_day == "AM" ? 1 : 2].classList.remove(...colors);
            event.path[1].children[half_day == "AM" ? 1 : 2].classList.add(next_color);
            updatedData[event.path[1].dataset.date + " " + half_day] = {
                "date": event.path[1].dataset.date,
                "meridiem": half_day,
                "color": next_color
            }
        } else {
            alert("Tu as déja été affecté, contact l'admin si tu n'es pas disponible")
        }
    });

    let btns = document.querySelector(".calendar .footer .btns").children
    btns[0].addEventListener("click", (event) => {
        location.href = ".?r=calendar"
    })
    btns[1].addEventListener("click", (event) => {
        let form = document.createElement('form');
        document.body.appendChild(form);
        form.method = 'post';
        form.action = location.search;
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = "data";
        input.value = JSON.stringify(updatedData);
        form.appendChild(input);
        form.submit();
    })

});