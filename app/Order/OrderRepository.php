<?php

namespace app\Order;

use app\Auth\Account;
use Carbon\Carbon;
use app\Helper\DB;

class OrderRepository
{


    public function getRecentCount(Account $account)
    {

        $result = DB::table('orders')
            ->where('account', $account->id)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5));

        return $result;
    }

    public function log(Order $order)
    {

        $result = DB::table('orders')
            ->insert(array(
                'account' => $order->account->id,
                'amount' => $order->amount,
                'created_at' => Carbon::now(),
            ));

        return $result;
    }
}