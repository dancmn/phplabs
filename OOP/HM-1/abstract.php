<?php

    abstract class Human 
    {
        private $name;

        public function __construct(string $name)
        {
            $this->name = $name;
        }

        public function getName(): string
        {
            return $this->name;
        }

        abstract public function getGreetings(): string;
        abstract public function getMyNameIs(): string;

        public function introduceYourself(): string
        {
            return $this->getGreetings() . '! ' . $this->getMyNameIs() . ' ' . $this->getName() . '.';
        }
    }

    class RussianHuman extends Human 
    {
        public function getGreetings(): string
        {
            return 'Привет';
        }

        public function getMyNameIs(): string 
        {
            return 'меня зовут';
        }
    }

    class EnglishHuman extends Human 
    {
        public function getGreetings(): string
        {
            return 'Hi';
        }

        public function getMyNameIs(): string 
        {
            return 'my name is';
        }
    }

    $petya = new RussianHuman('Петя');
    $john = new EnglishHuman('John');
    print_r($petya->introduceYourself());
    echo '<br>';
    print_r($john->introduceYourself());