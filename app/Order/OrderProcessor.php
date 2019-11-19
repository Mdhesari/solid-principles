<?php

namespace app\Order;

use app\Illuminate\BillerInterface;

class OrderProcessor
{

    public function __construct(BillerInterface $biller, OrderRepository $order)
    {

        $this->biller = $biller;
        $this->order = $order;
    }

    public function process(Order $order)
    {

        $exists = $this->order->getRecentCount($order->account);

        if ($exists > 0) {

            throw new Exception('Duplicate order likely.');
        }

        $this->biller->bill($order->account->id, $order->amount);

        $this->order->log($order);
    }
}
