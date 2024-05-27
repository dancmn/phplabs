<?php
    return [
        '/(^$)/' =>[\src\Controllers\MainController::class, 'main'],
        '/hello\/([a-z]+)/' => [\src\Controllers\MainController::class,'sayHello'],
        '/articles/' => [\src\Controllers\ArticleController::class,'index'],
        '/article\/create/' => [\src\Controllers\ArticleController::class,'create'],
        '/article\/store/' => [\src\Controllers\ArticleController::class,'store'],
        '/article\/(\d+)$/' => [\src\Controllers\ArticleController::class,'show'],
        '/article\/edit\/(\d+)/' => [\src\Controllers\ArticleController::class,'edit'],
        '/article\/update\/(\d+)/' => [\src\Controllers\ArticleController::class,'update'],
        '/article\/delete\/(\d+)/' => [\src\Controllers\ArticleController::class,'delete'],
        '/article\/(\d+)\/comments\/store/' => [\src\Controllers\CommentController::class,'store'],
        '/article\/\d+\/comments\/edit\/(\d+)$/' => [\src\Controllers\CommentController::class,'edit'],
        '/article\/\d+\/comments\/update\/(\d+)$/' => [\src\Controllers\CommentController::class,'update'],
        '/article\/\d+\/comments\/delete\/(\d+)$/' => [\src\Controllers\CommentController::class, 'delete'],
    ];