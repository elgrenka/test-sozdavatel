// Функция, которая устанавливает значок [+] для элементов li с вложенными списками
// и регистрирует функцию aClick для всех ссылок
function setPlusIcon() {
    let lis = document.getElementsByTagName("li");
    for (let li of lis) {
        let uls = li.getElementsByTagName("ul");
        if (uls.length > 0) {
            // Устанавливаем для li класс plus, который добавляет значок [+]
            li.className = "plus";
            let as = li.getElementsByTagName("a");
            for (let a of as) {
                a.onclick = aClick;
            }
        }
    }
}

// Функция, которая обрабатывает щелчок по ссылке
function aClick(event) {
    let a = event.target;
    let li = a.parentNode;
    let ul = li.getElementsByTagName("ul")[0];
    // Если вложенного списка нет - разрешаем переход по ссылке
    if (!ul) return true;
    ul.style.display = ul.style.display === "none" ? "block" : "none";
    li.className = li.className === "plus" ? "minus" : "plus";
    // Запрещаем переход по ссылке
    return false;
}

window.onload = setPlusIcon;
