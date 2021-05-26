function searchTable() {
    let input, filter, table, tr, title, i, titleValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        title = tr[i].getElementsByTagName("td")[0];
        if (title) {
            titleValue = title.textContent || title.innerText;
            if (titleValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
