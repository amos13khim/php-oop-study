<?php

class A
{
    public function sayHello()
    {
        return "Hello, I am A";
    }

    public function method1()
    {
        return $this->method2();
    }

    public function method2() {
        return 'I am A';
    }
}