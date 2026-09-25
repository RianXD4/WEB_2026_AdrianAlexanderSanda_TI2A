document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});

function initNavToggle(){
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function(){
        nav.classList.toggle("nav-open")
    })
}

function initHapusConfirm() {
    document.querySelectorAll(".btn-hapus").forEach(function (btn){
        btn.addEventListener("click", function(){
            const row = btn.closest("tr");
            const nama = row ? row.querySelector("td")?.textContent : ("Data ini");
            const yakin = confirm("Yakin ingin menghapus \""+ nama + "\"?");
            if (yakin && row) {
                row.remove();
            }
        }); 
    });
}


function initTableFilter(){
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if(!input || !table) return;

    input.addEventListener("keyup", function(){
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row){
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword)?"":"none";        })
    })
}

function tampilkanError(input, pesan){
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input){
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

function initValidasiForm(){
    const form = document.getElementById("form-tambah");
    if (!form) return;
    
    form.addEventListener("submit", function(e){
        let valid = true;

        const judul = form.querySelector("[name='judul'], [name='nama']");
        if (judul && judul.value.trim() === "") {
            tampilkanError(judul, "field ini wajib diisi");
            valid = false;
        } else if(judul){
            hapusError(judul);
        }

        const tahun = form.querySelector("[name='tahun']");
        if (tahun){
            const nilai = parseInt(tahun.value, 10);
            if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
                tampilkanError(tahun, "Tahun harus diantara 1900-2026");
                valid = false;
            } else {
                hapusError(tahun);
            }
        }

        if(!valid)
            e.preventDefault();
    }
    )
}