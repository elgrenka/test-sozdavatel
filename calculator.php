<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
</head>
<body>
<h1>Calculator</h1>

<form action="calculator.php" method="post">
    <input type="text" name="num1" placeholder="Number 1" required>
    <select name="operation" required>
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="/">/</option>
        <option value="*">*</option>
    </select>
    <input type="text" name="num2" placeholder="Number 2" required>
    <input type="submit" value="Calculate">
</form>

<?php
// Обработка формы и выполнение вычислений
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operation = $_POST['operation'];

    $result = '';

    if (is_numeric($num1) && is_numeric($num2)) {
        switch ($operation) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '/':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = 'Error: Division by zero';
                }
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            default:
                $result = 'Error: Invalid operation';
                break;
        }
    } else {
        $result = 'Error: Invalid numbers';
    }

    echo '<h2>Result:</h2>';
    echo '<p>' . $result . '</p>';
}
?>
</body>
</html>

