<?php

namespace src\Models\Comments;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;

class Comment extends ActiveRecordEntity{
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    public function getAuthorId()
    {
        return User::getById($this->authorId);
    }

    public function getArticleId()
    {
        return $this->articleId;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setAuthorId(int $authorId)
    {
        $this->authorId = $authorId;
    }

    public function setArticleId(int $articleId)
    {
        $this->articleId = $articleId;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    protected static function getTableName()
    {
        return 'comments';
    }
}