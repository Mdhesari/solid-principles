<?php

/**
 * 
 * (O) Opened/Closed Principle
 * 
 * This principle says : Software entities should be opened for extensions but not for modifications, it means it has to be open for implementing new functionalities in future
 * 
 */

interface ShapeInterface
{

    /**
     * Calculate area of the shape
     *
     * @return mixed
     */
    public function area();
}

class circle implements ShapeInterface
{

    private $radius;

    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    /**
     * Calculate area of the shape
     *
     * @return mixed
     */
    public function area()
    {

        return floor($this->radius ** 2 * pi());
    }
}

class Square implements ShapeInterface
{

    private $length;

    public function __construct($length)
    {
        $this->length = $length;
    }

    /**
     * Calculate area of the shape
     *
     * @return mixed
     */
    public function area()
    {

        return $this->length * $this->length;
    }
}

class Triangle implements ShapeInterface
{

    private $length;

    private $height;

    public function __construct($length, $height)
    {
        $this->length = $length;

        $this->height = $height;
    }

    /**
     * Calculate area of the shape
     *
     * @return mixed
     */
    public function area()
    {

        return ($this->length * $this->height) / 2;
    }
}

class AreaCalculate
{

    private $shapes = [];

    public function __construct(array $shapes)
    {

        $this->shapes = $shapes;
    }

    /**
     * sum
     *
     * @return void
     */
    public function sum()
    {

        $sum = 0;

        foreach ($this->shapes as $shape) {

            $sum += $shape->area();
        }

        return $sum;
    }
}


$circle1 = new circle(3);
$circle2 = new circle(1);
$circle3 = new circle(6);

$square = new Square(10);

$triangle = new Triangle(6, 4);

$areas = new AreaCalculate([$circle1, $circle2, $circle3, $square, $triangle]);

echo $areas->sum();
