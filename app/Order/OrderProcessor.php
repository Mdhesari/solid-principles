<?php

namespace app\Order;

use app\Illuminate\BillerInterface;
use app\Illuminate\OrderRepositoryInterface;

class OrderProcessor
{

    /**
     * Inject dependencies and set properties
     *
     * @param  \app\Illuminate\BillerInterface $biller
     * @param  \app\Order\Repository\OrderRepositoryInterface $order
     * @param  array $validators
     *
     * @return void
     */
    public function __construct(BillerInterface $biller, OrderRepositoryInterface $order, array $validators = [])
    {

        $this->biller = $biller;
        $this->order = $order;
        $this->validators = $validators;
    }

    /**
     * process
     *
     * @param  \app\Order\Order $order
     *
     * @return void
     */
    public function process(Order $order)
    {

        foreach ($this->validators as $validator) {

            if (!$validator->validate()) {

                return false;
            }
        }

        $this->biller->bill($order->account->id, $order->amount);

        $this->order->log($order);
    }
}
