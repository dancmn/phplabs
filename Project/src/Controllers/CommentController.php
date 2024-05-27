<?php

namespace src\Controllers;

use ReflectionObject;
use src\Models\Comments\Comment;
use src\Models\Users\User;
use src\Models\Articles\Article;
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

    public function update(int $id){
        $comment = Comment::getById($id);
        $comment->setAuthorId($comment->getAuthorId()->getId());
        $comment->setArticleId($comment->getArticleId());
        $comment->setText($_POST['text']);
        $comment->save();
        header('Location:/phplabs/Project/www/article/'.$comment->getArticleId());
    }

    public function edit(int $id){
        $users = User::findAll();
        $comment = Comment::getById($id);
        $article_id = $comment->getArticleId();
        $article = Article::getByid($article_id);
        $this->view->renderHtml('comments/update.php', ['comment' => $comment, 'users'=>$users, 'article'=>$article]);
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