<?php

namespace app\Order\Validators;

use app\Order\Order;
use app\Illuminate\OrderValidationInterface;

class OrderSuspendedAccountValidator implements OrderValidationInterface
{

    public function validate(Order $order)
    {

        if ($order->account->isSuspended()) {

            throw new Exception('The account is suspended.');
        }

        return true;
    }
}
