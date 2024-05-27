<?php
 namespace src\View;

 class View{
    // private $pathTemplate;
    // public function __construct(string $path){
    //     $this->pathTemplate = $path;
    // }

    public function __construct(private $pathTemplate){}
    public function renderHtml(string $templateName, array $var=[], $code = 200){
        http_response_code($code);
        extract($var);
        include($this->pathTemplate.$templateName);
    }
 }