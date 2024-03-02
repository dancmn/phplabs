<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $problem = $_POST['problem'];

        $characters = str_split($problem);
        $spacedProblem = implode(' ', $characters);
        
        $result = calculator(bracket($spacedProblem));
    
        echo $result;
    }

    function calculator($problem) {
        if (substr_count($problem, '+') > 0) {
            $plus = explode('+', $problem);
            $result = calculator($plus[0]);
            foreach (array_slice($plus, 1) as $elem) {
                $result += calculator($elem);
            }
            return $result;
        } elseif ((substr_count($problem, '-') > 0)) {
            $minus = explode('-', $problem);
            $result = calculator($minus[0]);
            foreach (array_slice($minus, 1) as $elem) {
                $result -= calculator($elem);
            }
            return $result;
        } elseif ((substr_count($problem, '*') > 0)) {
            $multi = explode('*', $problem);
            $result = calculator($multi[0]);
            foreach (array_slice($multi, 1) as $elem) {
                $result *= calculator($elem);
            }
            return $result;
        } elseif ((substr_count($problem, '/') > 0)) {
            $division = explode('/', $problem);
            $result = calculator($division[0]);
            foreach (array_slice($division, 1) as $elem) {
                $result /= calculator($elem);
            }
            return $result;
        } else {
            return (int)$problem;
        }
    }

    function bracket($problem) {
        while (substr_count($problem, '(') > 0) {
            $right = strpos($problem, ')');
            $left = strrpos(substr($problem, 0, $right), '(');
            $problem = substr_replace($problem, calculator(substr($problem, $left+1, $right-$left+1)), $left, $right-$left+1);
        }
        return $problem;
    }
?>
