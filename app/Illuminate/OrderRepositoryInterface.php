<?php

namespace app\Illuminate;

use app\Order\Order;

interface OrderRepositoryInterface {

    /**
     * Insert the data to database by injected db dependency
     *
     * @param  mixed $order
     *
     * @return void
     */
    public function log(Order $order);
}