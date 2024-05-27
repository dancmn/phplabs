<?php

namespace src\Controllers;

use ReflectionObject;
use src\View\View;
use src\Models\Articles\Article;
use src\Models\Comments\Comment;
use src\Models\Users\User;

class ArticleController{
    public $view;
    public $db;
    public function __construct(){
        $this->view = new View('../templates/');
    }

    public function index(){
        $articles=Article::findAll();
        $this->view->renderHtml('articles/index.php', ['articles'=>$articles]);
    }

    public function show(int $id){
        $article = Article::getById($id);
        if ($article == []){
            $this->view->renderHtml('errors/404.php',[],404);
            return;
        }

        $users = User::findAll();

        $allComments = Comment::findAll();

        $comments = array_filter($allComments, function ($comment) use ($article) {
            return $comment->getArticleId() === $article->getId();
        });

        $this->view->renderHtml('articles/show.php', ['article'=>$article, 'comments'=>$comments, 'users'=>$users]);
    }

    public function create(){
        $this->view->renderHtml('articles/create.php');
    }

    public function store(){
        $article = new Article;
        $article->setName($_POST['title']);
        $article->setText($_POST['text']);
        $article->setAuthorId($_POST['authorId']);
        $article->save();
        header('Location:/phplabs/Project/www/articles');
    }

    public function edit(int $id){
        $article = Article::getById($id);
        $this->view->renderHtml('articles/update.php', ['article'=>$article]);
    }

    public function update(int $id){
        $article = Article::getById($id);
        $article->setName($_POST['title']);
        $article->setText($_POST['text']);
        $article->setAuthorId($_POST['authorId']);
        $article->save();
        header('Location:/phplabs/Project/www/article/'.$article->getId());
    }
    
    public function delete(int $id){
        $article = Article::getById($id);
        $article->delete();
        header('Location:/phplabs/Project/www/articles');
    }
}