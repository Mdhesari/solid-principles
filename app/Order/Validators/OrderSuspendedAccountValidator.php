<?php

namespace app\Order\Validators;

use app\Order\Order;
use app\Illuminate\OrderValidationInterface;

class OrderSuspendedAccountValidator implements OrderValidationInterface
{

    /**
     * Fetch required data from injected order repository and check if it exists so throw new error \Exception
     *
     * @param \app\Order\Order $order
     *
     * @return void/bool
     */
    public function validate(Order $order)
    {

        if ($order->account->isSuspended()) {

            throw new Exception('The account is suspended.');

            return false;
        }

        return true;
    }
}
