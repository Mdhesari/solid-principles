<?php

require_once 'vendor/autoload.php';

use Carbon\Carbon;

@date_default_timezone_set('Asia/Tehran');

function now()
{

    return date('Y-M-d h:m:s');
}

function parseTime($time_stamp)
{

    $date = new DateTime($time_stamp, new DateTimeZone('Asia/Tehran'));

    return $date->getDate();
}

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

class OrderProcessor
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

        dd($time);

        DB::table('orders')
            ->where('account', $order->account->id)
            ->where('created_at', '>=', $time);
    }
}

$time = Carbon::now()->subMinutes(5);

        dd($time);

echo now();

