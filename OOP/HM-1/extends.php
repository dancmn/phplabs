<?php

    class Post{
        public function __construct(
            protected $title, 
            protected $text
        ){}

        public function setTitle(string $title){
            $this->title = $title;
        }
        public function setText(string $text){
            $this->title = $text;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getText(){
            return $this->text;
        }
    }

    class Lesson extends Post{
        public $homeWork;
        public function __construct(string $title,string $text, string $homeWork){
            parent::__construct($title, $text);
            $this->homeWork = $homeWork;
        }
    }

    class PaidLesson extends Lesson
    {
        private $price;

        public function setPrice(float $price){
            $this->price = $price;
        }
        public function getPrice(){
            return $this->price;
        }

        public function __construct(string $title,string $text, string $homeWork, float $price){
            parent::__construct($title, $text, $homeWork);
            $this->price = $price;
        }

    }

    $paidLesson = new PaidLesson('Урок о наследовании PHP', 'Лол, кек, чебурек', 'Ложитесь спать, утро вечера мудренее', 99.90);
    var_dump($paidLesson);