<?php

require_once 'bootstrap.php';

use app\Order\Order;
use app\Order\OrderProcessor;
use app\Order\OrderRepository;
use app\Order\OrderBiller;
use app\Auth\Account;

$order = new Order(5, new Account);

$order_proccessor = new OrderProcessor(new OrderBiller(1, 5), new OrderRepository);

$order_proccessor->process($order);