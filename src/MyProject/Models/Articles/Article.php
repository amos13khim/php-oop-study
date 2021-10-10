<?php
namespace MyProject\Models\Articles;
use \MyProject\Models\Users\User;
use \MyProject\Services\Db;
use \MyProject\Models\ActiveRecordEntity;

class Article extends ActiveRecordEntity
{
    /** @var string  */
    protected $name;

    /** @var string  */
    protected $text;

    /** @var int */
    protected $authorId;

    /** @var string */
    protected $createdAt;

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function setName($name) : void
    {
        $this->name = $name;
    }

    public function setText($text) : void
    {
        $this->text = $text;
    }

    public function setAuthor(User $author) : void
    {
        $this->authorId = $author->getId();
    }

    protected static function getTableName() : string
    {
        return 'articles';
    }

}