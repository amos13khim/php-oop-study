<?php

class RussianHuman extends AbstractHuman
{
    public function getGreetings(): string
    {
        return 'Привет, Товарищ';
    }

    public function getMyNameIs(): string
    {
        return 'Меня зовут';
    }
}