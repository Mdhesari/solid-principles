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

/* $manager = new ProjectManager;

$manager->processDevelop(new Developer);

$manager->processTest(new Developer);

 */


/**
 * Wrong way of using solid principle
 */
class DatePicker
{

    private $fieldName;

    public function __construct(string $fieldName, array $options)
    {

        if ($options['isRequired']) {

            // do sth
        }

        $this->fieldName = $fieldName;

        // do other things
    }
}

$my_date_picker = new DatePicker('mydatepicker', ['isrequired' => true]);

/**
 * Better way to use solid principle 
 */

class DatePick
{

    private $fieldName;

    public function __construct(string $fieldName, DatePickOptions $options = null)
    {

        if (is_null($options)) {

            $options = new DatePickOptions;
        }

        if ($options->isRequired()) {

            // do sth
        }

        $this->fieldName = $fieldName;

        // do other things
    }

    public function get(): string
    {

        return "Your Datepicker is ready!";
    }
}

class DatePickOptions
{
    /**
     * Main Properties
     */
    private $isRequiredField = false;

    private $label = "My date picker.";

    /**
     * Settings
     */
    private $max_label_length = 32;

    public function setMaxLabelLength(int $length)
    {

        $this->max_label_length = $length;
    }

    public function setLabel(string $label)
    {

        if (strlen($label) > $this->max_label_length) {

            throw new Exception(" Label length is not valid, its character must not be more than {$this->max_label_length}. ");
        }

        $this->label = $label;
    }

    public function isRequired(): bool
    {

        return $this->isRequiredField;
    }


    public function setIsRequired(bool $value)
    {

        $this->isRequiredField = $value;
    }
}


$nimckat = new DatePick('nimckat');

echo $nimckat->get();
