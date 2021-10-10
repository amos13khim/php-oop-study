<?php

namespace MyProject\Controllers;
use \MyProject\Models\Users\User;
use \MyProject\View\View;
use \MyProject\Models\Articles\Article;


class ArticlesController
{
    /** @var View  */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        $reflerctor = new \ReflectionObject($article);
        $properties = $reflerctor->getProperties();
        $propertiesNames = [];
        foreach ($properties as $property) {
            $propertiesNames[] = $property->getName();
        }

        if( $article === [] ) {
           $this->view->renderHtml('errors/404.php', [],404);
           return;
        }

        $this->view->renderHtml(
           'articles/view.php',
           [
               'article' => $article
           ]
        );
    }

    public function edit(int $articleId) : void
    {
        $article = Article::getById($articleId);

        if( $article === [] ) {
            $this->view->renderHtml('errors/404.php', [],404);
            return;
        }

        $article->setName('New Article Name');
        $article->setText('New Article Text');

        $article->save();
    }

    public function add() : void
    {
        $author = User::getById(1);

        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название статьи 3');
        $article->setText('Новый текст статьи 3');

        $article->save();
        xdebug_var_dump($article);
    }
}