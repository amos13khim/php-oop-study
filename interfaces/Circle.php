<?php
// implements CalculateSquare
class Circle
{
    private $r;
    const PI = 3.1416;

    public function __construct( float $r )
    {
        $this->r = $r;
    }

    public function calculateSquare() : float
    {
        return self::PI * ( $this->r ** 2 );
    }
}