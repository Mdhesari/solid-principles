<?php

namespace app\Order;

use app\Auth\Account;
use app\Order\OrderProcessor;

class Order
{
    public function __construct(int $amount, Account $account)
    {

        $this->amount = $amount;
        $this->account = $account;
    }
}
