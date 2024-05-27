<?php

namespace src\Controllers;

use ReflectionObject;
use src\Models\Comments\Comment;
use src\Models\Users\User;
use src\View\View;


class CommentController{
    private $view;

    public function __construct(){
        $this->view = new View('../templates/');
    }

    public function store(int $articleId){
        $comment = new Comment();
        $comment->setAuthorId($_POST['author_id']);
        $comment->setArticleId($_POST['article_id']);
        $comment->setText($_POST['text']);
        $comment->save();
        $article_id = $comment->getArticleId();
        header('Location:/phplabs/Project/www/article/' . $article_id);
    }

    public function edit(int $id){
        $comment = Comment::getById($id);

        $this->view->renderHtml('comments/update.php', ['comment' => $comment]);
    }

    public function delete(int $id){
        $comment = Comment::getById($id);
        $comment->delete();
        $article_id = $comment->getArticleId();
        header('Location:/phplabs/Project/www/article/' . $article_id);
    }

    public static function getTableName(){
        return 'comments';
    }
}