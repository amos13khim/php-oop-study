<?php

class B extends A
{
    public function sayHello()
    {
        return parent::sayHello() . ' ... HA! It was a joke! I am B';
    }

    public function method2()
    {
        return 'I am B';
    }
}