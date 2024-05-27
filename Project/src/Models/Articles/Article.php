<?php

namespace src\Models\Articles;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;
use src\Models\Comments\Comment;

    class Article extends ActiveRecordEntity{
        protected $name;
        protected $text;
        protected $authorId;
        protected $createdAt;

        // public function __construct(){}

        public function getName(){
            return $this->name;
        }
        public function getText(){
            return $this->text;
        }
        public function getAuthorId()
        {
            return User::getById($this->authorId);
        }
        public function setName(string $name){
            $this->name = $name;
        }
        public function setText(string $text){
            $this->text = $text;
        }
        public function setAuthorId(int $authorId){
            $this->authorId = $authorId;
        }
        protected static function getTableName(){
            return 'articles';
        }
    }