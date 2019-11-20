<?php

namespace app\Order\Validators;

use app\Illuminate\OrderRepositoryInterface;
use app\Illuminate\OrderValidationInterface;
use app\Order\Order;

class OrderRecentValidator implements OrderValidationInterface
{

    /**
     * Inject Dependencies
     *
     * @param \app\Illuminate\OrderRepositoryInterface $order
     *
     * @return void
     */
    public function __construct(OrderRepositoryInterface $order)
    {
        $this->orderRepo = $order;
    }

    /**
     * Fetch required data from injected order repository and check if it exists so throw new error \Exception
     *
     * @param \app\Order\Order $order
     *
     * @return void/bool
     */
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
