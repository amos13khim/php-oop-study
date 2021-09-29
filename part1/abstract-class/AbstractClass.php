<?php

abstract class AbstractClass
{
    abstract public function getValue();

    public function printValue()
    {
        echo "<p>Значение: " . $this->getValue();
    }
}