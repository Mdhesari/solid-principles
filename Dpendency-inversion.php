    <?php

    /**
     * 
     * (D) Dependency Inversion Principle
     * 
     * This principle says : top level modules of the application should not be dependent on bottom level modules.
     * 
     * For solution we use dependency injection
     * 
     */

    interface Driver
    {

        public function send($message);
    }


    class Mail implements Driver
    {

        public function send($message)
        {

            // $message action
        }
    }

    class SMS implements Driver
    {

        public function send($message)
        {

            // $message action
        }
    }

    class sendMessage
    {

        protected $driver;

        public function __construct(Driver $driver)
        {
            $this->driver = $driver;
        }

        public function send($message)
        {

            $this->driver->send($message);
        }
    }

    $mySender = new sendMessage(new SMS);

    $mySender->send('hi welcome');
