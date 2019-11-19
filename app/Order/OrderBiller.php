<?php

namespace app\Order;

use app\Illuminate\BillerInterface;

class OrderBiller implements BillerInterface
{

    public function bill(int $id, int $amount)
    {

        // do sth
    }
}
