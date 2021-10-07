<?php
namespace MyProject\Models\Articles;
use \MyProject\Models\Users\User;
class Article
{
    /** @var int */
    private $id;

    /** @var string  */
    private $name;

    /** @var string  */
    private $text;

    /** @var int */
    private $authorId;

    /** @var string */
    private $createdAt;

    public function __construct()
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function __set(string $name, $value): void
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source) : string
    {
        return lcfirst(str_replace('_','',ucwords($source,'_')));
    }
}