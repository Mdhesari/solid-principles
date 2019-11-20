<?php

namespace app\Illuminate;

use app\Order\Order;

interface OrderRepositoryInterface {

    public function log(Order $order);
}