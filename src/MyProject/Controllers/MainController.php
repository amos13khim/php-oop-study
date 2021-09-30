<?php
namespace MyProject\Controllers;
class MainController
{
    public function main()
    {
        echo "Homepage";
    }

    public function sayHello( string $name )
    {
        echo "Hello, " . $name . "!";
    }

    public function sayBye( string $name )
    {
        echo "Bye, " . $name . "!";
    }
}