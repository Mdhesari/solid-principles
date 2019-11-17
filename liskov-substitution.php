<?php

/**
 * 
 * (L) Liscov Substitution Principle
 * 
 * This principles says : if your are inheriting a class, the child class should look after her father and do almost the same thing as father does
 * 
 */

class School
{

    protected $capacity;

    protected $name;

    protected $manager;

    protected $teachers = [];

    protected $students = [];

    public function __construct($capacity, $name, $manager, $teachers = [], $students = [])
    {

        $this->capacity = $capacity;

        $this->name = $name;

        $this->manager = $manager;

        $this->teachers = $teachers;

        $this->students = $students;
    }

    public function work()
    {

        return '7 to 14';
    }
}

class College extends School
{

    /**
     * Here the liscov substituation principle is not working accurately and methods return different types
     *
     * @return void
     */
    public function work()
    {

        return true;
    }
}

$ahrar = new School(300, 'Ahrar', 'Naeimi', ['ahmadzadegan', 'haqiqi'], ['mohamad', 'jeysad', 'reza', 'hossein', 'mahdi']);

$shamsipour = new College(600, 'Shamsi pour', 'rezaei');

echo $ahrar->work();

echo $shamsipour->work();
