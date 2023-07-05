let inputField = document.getElementById('inputField');
let undoButton = document.getElementById('undoButton');

// Массив для хранения истории состояний формы
let formHistory = [];

// Функция для сохранения текущего состояния формы в истории
function saveFormState() {
    formHistory.push(inputField.value);
}

// Функция для отмены последнего изменения в форме
function undoLastChange() {
    if (formHistory.length > 1) {
        formHistory.pop();
        inputField.value = formHistory[formHistory.length - 1];

    }
}

// Обработчик события изменения значения в поле ввода
inputField.addEventListener('input', saveFormState);

// Обработчик события клика по кнопке "Назад"
undoButton.addEventListener('click', undoLastChange);


