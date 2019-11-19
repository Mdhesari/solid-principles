
<?php

/**
 * 
 * (S) Single Responsibility Principle
 * 
 * This principles says : A class only and only should have one job and one task to do.
 * 
 * Which means it should have one and only one reason to change
 * 
 */

class Order
{

    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function calcSumItems()
    {

        $sum = 0;

        foreach ($this->items as $item) {

            if (is_int($item)) {
                $sum += $item;
            } else {

                throw new Exception("Order items index must be int type.");
            }
        }

        return $sum;
    }

    public function format(Outputter $driver)
    {

        $driver->add('سفارش های ثبت شده : \n', "h1");

        $driver->add($this->items, "h3");

        return $driver->output();
    }
}

interface Outputter
{

    public function __construct($content = "");

    public function add($str,  $tagName);

    public function output();
}

class JsonOutputter implements Outputter
{

    private $content;

    public function __construct($content = "")
    {

        $this->content = $content;
    }

    public function add($str,  $tagName)
    {

        $this->clearText($str);

        $this->content .= $str;
    }

    public function output()
    {

        return json_encode($this->content, JSON_PRETTY_PRINT);
    }

    private function clearText(&$str)
    {

        if (is_array($str)) {

            $str = join(PHP_EOL, $str);
        }
    }
}

class HTMLOutputter implements Outputter
{

    private $content;

    private $tagName = "p";

    protected $template =            [
        'html5' =>                                  '
                                                    <!DOCTYPE html>
                                                    <html lang="en">
                                                    <head>
                                                        <meta charset="UTF-8">
                                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                                        <title>Document</title>

                                                        <style>
                                                        html, body, * {
                                                            direction:rtl;
                                                            text-align:center;
                                                            background:#f1f2f3;
                                                            color:#555;
                                                            padding:1em;
                                                            line-height:42px;
                                                        }
                                                        </style>
                                                    </head>
                                                    <body>
                                                        {content}
                                                        </body>
                                                    </html>
                                                    '
    ];

    /**
     * __construct
     *
     * @param  mixed $content
     *
     * @return void
     */
    public function __construct($content = "")
    {
        $this->content = $content;
    }

    /**
     * output
     *
     * @return void
     */
    public function output()
    {
        return str_replace('{content}', $this->content, $this->template['html5']);
    }

    /**
     * Append new text
     *
     * @param  mixed $str
     *
     * @return void
     */
    public function add($str, $tagName = null)
    {

        $this->clearText($str, $tagName);

        $this->content .= $str;
    }

    public function changeTag($name = "h5")
    {

        $this->tagName = $name;
    }

    /**
     * clearText
     *
     * @return void
     */
    private function clearText(&$str, $tagName = null)
    {

        if (is_array($str)) {

            $str = join("</br>", $str);
        }

        if ($tagName !== null) {

            $current = $this->tagName;

            $this->tagName = $tagName;
        }

        $str = "<{$this->tagName}>" . str_replace('\\n', '<br>', $str) . "</{$this->tagName}>";

        if ($tagName !== null) {

            $this->tagName = $current;
        }
    }
}

class Printer
{

    protected $module;

    public function __construct(Outputter $module)
    {
        $this->module = $module;
    }

    public function print()
    {
        echo $this->module->output();
    }
}


$order = new Order(array('tablet', 'laptop', 'mouse'));

echo $order->format(new HTMLOutputter);
