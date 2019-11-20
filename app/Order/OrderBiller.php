<?php

namespace app\Order;

use app\Illuminate\BillerInterface;

class OrderBiller implements BillerInterface
{

    /**
     * generate a new bill
     *
     * @param  int $id
     * @param  int $amount
     *
     * @return void
     */
    public function bill(int $id, int $amount)
    {

        // do sth
    }
}
