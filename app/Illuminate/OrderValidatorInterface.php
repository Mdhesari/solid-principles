<?php

namespace app\Illuminate;

use app\Order\Order;

interface OrderValidationInterface
{

    /**
     * Fetch required data from injected order repository and check if it exists so throw new error \Exception
     *
     * @param \app\Order\Order $order
     *
     * @return void/bool
     */
    public function validate(Order $order);
}
