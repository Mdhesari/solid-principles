<?php

namespace app\Order\Validators;

use app\Illuminate\OrderRepositoryInterface;
use app\Illuminate\OrderValidationInterface;
use app\Order\Order;

class OrderRecentValidator implements OrderValidationInterface
{

    public function __construct(OrderRepositoryInterface $order)
    {
        $this->orderRepo = $order;
    }

    public function validate(Order $order)
    {

        $exists = $this->orderRepo->getRecentCount($order->account);

        if ($exists > 0) {

            throw new Exception('Duplicate order likely.');

            return false;
        }

        return true;
    }
}
