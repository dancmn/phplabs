<?php
    class Cat {

        public $name;
        private $color;

        public function getColor()
        {
            return $this->color;
        }

        public function __construct($name, $color)
        {
            $this->name = $name;
            $this->color = $color;
        }

        public function sayHello() {
            return 'Привет! Меня зовут ' . $this->name . ', мой цвет - ' . $this->getColor() . '.';
        }
    }

    $cat = new Cat('Маруся', 'оранжевый');
    print_r($cat->sayHello());