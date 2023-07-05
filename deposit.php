<?php
function calculateDeposit($amount, $months, $rate): float|int {
    if ($amount <= 0 || $months <= 0 || $rate <= 0) {
        return 'Некорректные значения аргументов';
    }

    return $amount + ($amount * $rate * $months / 12) / 100; // Вычисление суммы вклада по окончанию срока
}

$totalAmount = calculateDeposit(1_000_000, 43, 19.5);
echo "Сумма вклада по окончанию срока: " . number_format($totalAmount, 2, ',', ' ') . " руб.";

