<?php

namespace app\Illuminate;

use app\Order\Order;

interface OrderValidationInterface
{

    public function validate(Order $order);
}
