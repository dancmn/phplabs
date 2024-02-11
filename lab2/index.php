<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $equation = 'x * 7 = 49';
        $elems = explode(" ", $equation);
        $operator = $elems[1];
        $operand = $elems[2];
        $result = $elems[4];
        $x = NAN;
        switch ($operator) {
            case '+':
                $x = $result - $operand;
                echo $x;
                break;
            case '-':
                $x = $result + $operand;
                echo $x;
                break;
            case '/':
                $x = $result * $operand;
                echo $x;
                break;
            case '*':
                $x = $result / $operand;
                echo $x;
                break;
            case '**':
                $x = $result ** (1 / $operand);
                echo $x;
                break;
            default:
                echo 'Неизвестный оператор';
        };
    ?>
</body>
</html>