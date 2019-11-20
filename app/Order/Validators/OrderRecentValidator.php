<?php

namespace app\Order\Validators;

use app\Illuminate\OrderValidationInterface;
use app\Order\Order;
use app\Order\OrderRepository;

class OrderRecentValidator implements OrderValidationInterface
{

    public function __construct(OrderRepository $order)
    {
        $this->orderRepo = $order;
    }

    public function validate(Order $order)
    {

        $exists = $this->orderRepo->getRecentCount($order->account);

        if ($exists > 0) {

            throw new Exception('Duplicate order likely.');

        }

        return true;
    }
}
