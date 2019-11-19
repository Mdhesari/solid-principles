<?php

require_once 'bootstrap.php';

use Carbon\Carbon;

interface BillerInterface
{

    public function bill(int $id, int $amount);
}

class Account
{
    //
}

class Order
{
    public function __construct(int $amount, Account $account)
    {

        $this->amount = $amount;
        $this->account = $account;
    }
}

/**
 * if we see here will understand that there is a wrong implementation which ignroes single responsibility principle
 * 
 * so here the solution is to create another class called OrderRepository and manage the logic and database operation over there.
 */
class Wrong_OrderProcessor
{

    public function __construct(BillerInterface $biller)
    {

        $this->biller = $biller;
    }

    public function process(Order $order)
    {

        $exists = $this->getRecentOrderCount($order);

        if ($exists > 0) {

            throw new Exception('Duplicate order likely.');
        }

        $this->biller->bill($order->account->id, $order->amount);

        DB::table('orders')->insert(array(
            'account' => $order->account->id,
            'amount' => $order->amount,
            'created_at' => now(),
        ));
    }

    public function getRecentOrderCount(Order $order)
    {

        $time = Carbon::now()->subMinutes(5);

        DB::table('orders')
            ->where('account', $order->account->id)
            ->where('created_at', '>=', $time);
    }
}

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
