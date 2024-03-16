<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $expression = $_POST['expression'];

        if (preg_match("/^[0-9\+\-\*\/\(\)sin\(\)cos\(\)tg\(\)ctg\(\)π\. ]+$/", $expression)) {
            $result = calculateExpression($expression);
            echo $result;
        } else if ($expression == '') {
            echo 'Ничего не введено!';
        }
        else {
            echo 'Неверное выражение!';
        }
    }

    function calculateExpression($expression) {
        $expression = str_replace(' ', '', $expression);
        return calculateAdditionAndSubtraction($expression);
    }

    function calculateAdditionAndSubtraction(&$expression) {
        $result = calculateMultiplicationAndDivision($expression);

        while (strlen($expression) > 0) {
            $operator = $expression[0];
            
            if ($operator == '+' || $operator == '-') {
                $expression = substr($expression, 1);
                $num2 = calculateMultiplicationAndDivision($expression);

                if ($operator == '+') {
                    $result += $num2;
                } elseif ($operator == '-') {
                    $result -= $num2;
                }
            } else {
                break;
            }
        }

        return $result;
    }

    function calculateMultiplicationAndDivision(&$expression) {
        $result = calculateTrigonometricFunctions($expression);

        while (strlen($expression) > 0) {
            $operator = $expression[0];

            if ($operator == '*' || $operator == '/') {
                $expression = substr($expression, 1);
                $num2 = calculateTrigonometricFunctions($expression);

                if ($operator == '*') {
                    $result *= $num2;
                } elseif ($operator == '/') {
                    if ($num2 == 0) {
                        $result = 'Деление на ноль!';
                    } else {
                        $result /= $num2;
                    }
                }
            } else {
                break;
            }
        }

        return $result;
    }

    function calculateTrigonometricFunctions(&$expression) {
        $result = calculateNumber($expression);
    
        while (strlen($expression) > 0) {
            if (substr($expression, 0, 3) == 'cos') {
                $expression = substr($expression, 3);
                $num = calculateNumber($expression);
                $numInRadians = $num * M_PI / 180;
                $result = cos($numInRadians);
            } else if (substr($expression, 0, 3) == 'sin') {
                $expression = substr($expression, 3);
                $num = calculateNumber($expression);
                $numInRadians = $num * M_PI / 180;
                $result = sin($numInRadians);
            }  else if (substr($expression, 0, 2) == 'tg') {
                $expression = substr($expression, 3);
                $num = calculateNumber($expression);
                $numInRadians = $num * M_PI / 180;
                $result = tan($numInRadians);
            }  else if (substr($expression, 0, 3) == 'ctg') {
                $expression = substr($expression, 3);
                $num = calculateNumber($expression);
                $numInRadians = $num * M_PI / 180;
                $result = 1 / tan($numInRadians);
            } else {
                break;
            }
        }
    
        return $result;
    }

    function calculateNumber(&$expression) {
        $number = "";
    
        if ($expression[0] == "(") {
            $expression = substr($expression, 1);
            $number = calculateAdditionAndSubtraction($expression);
            $expression = substr($expression, 1); 
        } else {
            while (strlen($expression) > 0 && (is_numeric($expression[0]) || $expression[0] == '.')) {
                $number .= $expression[0];
                $expression = substr($expression, 1);
            }
            $number = floatval($number);
        }
    
        return $number;
    }