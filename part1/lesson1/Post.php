<?php
class Post
{
    private $title;
    private $text;

    public function __construct(string $title, string $text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setTitle( string $title ) : void
    {
        $this->title = $title;
    }

    public function setText( string $text ) : void
    {
        $this->text = $text;
    }
}