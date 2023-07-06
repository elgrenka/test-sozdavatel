let button = document.getElementById("toggle");
let catalog = document.querySelector(".catalog");
let listView = false;

button.addEventListener("click", function() {
    listView = !listView;
    if (listView) {
        catalog.classList.add("list-view");
    } else {
        catalog.classList.remove("list-view");
    }
});

