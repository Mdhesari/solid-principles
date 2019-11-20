<?php

namespace app\Order;

use app\Auth\Account;
use app\Order\OrderProcessor;

class Order
{
    /**
     * Inject dependencies
     *
     * @param  int $amount
     * @param  \app\Auth\Account $account
     *
     * @return void
     */
    public function __construct(int $amount, Account $account)
    {

        $this->amount = $amount;
        $this->account = $account;
    }
}
