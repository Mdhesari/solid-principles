<?php

/**
 * 
 * (I) : Interface Segregation
 * 
 * A class who does not use interface method in reality should not implement the interface but need to create new one for itself.
 * 
 */

interface DevelopInterface
{

    public function develop();
}

interface TestInterface
{

    public function test();
}

class Tester implements TestInterface
{

    public function test()
    {

        return 'test...';
    }
}

class Developer implements DevelopInterface, TestInterface
{

    public function develop()
    {

        return 'develop...';
    }

    public function test()
    {

        return 'test...';
    }
}



class ProjectManager
{

    public function processDevelop(DevelopInterface $developer)
    {

        return $developer->develop();
    }

    public function processTest(TestInterface $tester)
    {

        return $tester->test();
    }
}

$manager = new ProjectManager;

$manager->processDevelop(new Developer);

$manager->processTest(new Developer);
