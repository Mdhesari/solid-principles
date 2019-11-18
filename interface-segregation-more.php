<?php

function dd($value)
{
    var_dump($value);

    die;
}

trait connection_setting
{
    private $hostname;

    private $port;

    private $awesomeness = true;

    private $persist = false;

    private $replaceable = false;
}

class Connection
{

    use connection_setting;

    public function __construct($hostname, $port, bool $awesomeness, bool $persist, bool $replaceable)
    {
        $this->hostname = $hostname;

        $this->port = $port;

        $this->awesomeness = $awesomeness;

        $this->persist = $persist;

        $this->replaceable = $replaceable;
    }
}

class ConnectionRepo
{

    use connection_setting;

    public function __construct($hostname, $port)
    {
        $this->hostname = $hostname;

        $this->port = $port;
    }

    public function __call($name, $arguments)
    {

        $pattern = "/^enable/i";

        $exists = preg_match($pattern, $name);

        if ($exists) {

            $name = strtolower(preg_replace($pattern, '', $name));

            $this->{$name} = true;

            return $this;
        }

        $pattern = "/^disable/i";

        $exists = preg_match($pattern, $name);

        if ($exists) {

            $name = strtolower(preg_replace($pattern, '', $name));

            $this->{$name} = false;

            return $this;
        }

        throw new Exception("Method does not exist.");
    }

    public function get()
    {

        return new Connection($this->hostname, $this->port, $this->awesomeness, $this->persist, $this->replaceable);
    }
}

function connect($hostname, $port)
{

    return new ConnectionRepo($hostname, $port);
}

$connetor = connect('local', 80)->enableAwesomeness()->enableReplaceable();
