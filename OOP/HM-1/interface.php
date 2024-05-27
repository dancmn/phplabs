<?php

    interface CalculateSquare {
        public function calculateSquare() : float;
    }

    class Rectangle implements CalculateSquare
    {
        public function __construct(
            public $x,
            public $y
        ){}
        public function calculateSquare() : float
        {
            return $this->x * $this->y;
        }
    }

    class Square implements CalculateSquare{
        public function __construct(
            public $x,
        ){}
        public function calculateSquare() : float
        {
            return $this->x ** 2;
        }
    }

    class Circle{

        const PI = 3.1416;

        public function __construct(
            public $r,
        ){}
        public function calculateSquare() : float
        {
             return self::PI * ($this->r**2);
        }
    }

    $object = [
        $rectangle = new Rectangle(3,4),
        $square = new Square(4),
        $cicrle = new Circle(8),
    ];

    foreach($object as $elem){
        if ($elem instanceof CalculateSquare)
            echo 'Площадь объекта равна: '.$elem->calculateSquare().'<br>';
        else echo 'Объект класса ' . get_class($elem) . ' не реализует интерфейс CalculateSquare';
    }