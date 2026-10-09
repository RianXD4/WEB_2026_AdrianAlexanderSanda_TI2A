document.addEventListener("DOMContentLoaded", function () {
    initAnggotaFilter();
});

function initAnggotaFilter(){
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if(!input || !table) return;
    if(table.dataset.filterBound === "true") return;
    table.dataset.filterBound = "true";

    input.addEventListener("keyup", function(){
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row){
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? "" : "none";
        });
    });
}
