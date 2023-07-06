let form = document.getElementById("form");
let name = form.elements["name"];
let phone = form.elements["phone"];
let email = form.elements["email"];

// Функция, которая проверяет, является ли поле text пустым
function isEmpty(text) {
    text = text.trim();
    return text === "";
}

// Функция, которая проверяет, является ли поле name валидным
function isName(name) {
    name = name.trim();
    if (name === "") return false;
    let regex = /^[А-ЯЁ][а-яё]* [А-ЯЁ][а-яё]*$/;
    return regex.test(name);
}

// Функция, которая проверяет, соответствует ли поле phone маске
function isPhone(phone) {
    // Создаем регулярное выражение для маски телефона +7 (999) 999-99-99
    let regex = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;
    return regex.test(phone);
}

// Функция, которая проверяет, соответствует ли поле email маске
function isEmail(email) {
    let regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return regex.test(email);
}

// Функция, которая валидирует форму
function validateForm() {
    let inputs = form.getElementsByTagName("input");
    for (let input of inputs) {
        let type = input.getAttribute("type");
        let value = input.value;
        let required = input.hasAttribute("required");
        let valid = true;

        if (required && type === "text") {
            valid = !isEmpty(value);
        }
        if (required && type === "tel") {
            valid = isPhone(value);
        }
        if (required && type === "email") {
            valid = isEmail(value);
        }
        // Если поле не прошло валидацию
        if (!valid) {
            input.className = "error";
            return false;
        } else {
            input.className = "";
        }
    }

    return true;
}

form.onsubmit = validateForm;
