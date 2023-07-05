<?php
function formatDate($day, $month): string {
    $months = [
        1 => 'января',
        2 => 'февраля',
        3 => 'марта',
        4 => 'апреля',
        5 => 'мая',
        6 => 'июня',
        7 => 'июля',
        8 => 'августа',
        9 => 'сентября',
        10 => 'октября',
        11 => 'ноября',
        12 => 'декабря'
    ];

    if ($day < 1 || $day > 31 || $month < 1 || $month > 12) {
        return 'Некорректная дата';
    }

    // Проверка количества дней в остальных месяцах
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));
    if ($day > $daysInMonth) {
        return 'Некорректная дата';
    }

    return "$day $months[$month]";
}

echo formatDate(11, 1) . ' ' . date('Y') . " года <br>";
echo formatDate(8, 6) . ' ' . date('Y') . " года <br>";
echo formatDate(29, 2) . ' ' . date('Y') . " года <br>";



