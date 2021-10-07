<?php
namespace MyProject\Controllers;
use \MyProject\Services\Db;
use \MyProject\View\View;
use \MyProject\Models\Articles\Article;
class MainController
{
    /** @var View  */
    private $view;

    /** @var Db  */
    private $Db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->Db = new Db();
    }

    public function main()
    {
        $articles = $this->Db->query('SELECT * FROM `articles`;',[],Article::class);
        $this->view->renderHtml('main/main.php', ['articles'=>$articles]);
    }

    public function sayHello( string $name )
    {
        $this->view->renderHtml('main/hello.php', ['name'=>$name, 'title'=>'Страница Приветствия']);
    }

    public function sayBye( string $name )
    {
        echo "Bye, " . $name . "!";
    }
}