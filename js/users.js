
function search() {
    let input = document.querySelector("#searchBox");
    let filter = input.value.toUpperCase();
    let table = document.querySelector("#users");
    let tr = table.querySelectorAll("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) {
        let td = tr[i].querySelectorAll("td");
        let result = false;
        for (u = 0; u < td.length; u++) {
            let txtValue = td[u].textContent || td[u].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                result = true;
            }
        }

        result ? tr[i].style.display = "" : tr[i].style.display = "none";
    }
}

async function sort(event) { 
    let dir = "asc";
    let switchcount = 0;
    let column = event.target.cellIndex;

    // S'il s'agit de la colonne actions, on ne fait rien
    if (column == 5) return;

    do{
        var switching = false;
        let rows = document.querySelectorAll("#users tr");
        for (i = 1; i < (rows.length - 1); i++) {
            let x = rows[i].querySelectorAll("TD")[column];
            let y = rows[i + 1].querySelectorAll("TD")[column];

            if (dir == "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()
                || dir == "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
                break;
            }
        }
        if (switchcount == 0) {
            dir = "desc";
            switching = true;
        }
    } while(switching);
}

document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("#searchBox").addEventListener("keyup", search);
    document.querySelector("#users tr").addEventListener("click", sort);
});


