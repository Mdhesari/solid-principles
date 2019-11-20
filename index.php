<?php

require_once 'bootstrap.php';

use app\Order\Order;
use app\Order\OrderProcessor;
use app\Order\OrderRepository;
use app\Order\OrderBiller;
use app\Auth\Account;

use app\Order\Validators\OrderRecentValidator;

$account = new Account;

$order = new Order(5, $account);

$order_repo = new OrderRepository;

$biller = new OrderBiller(1, 5);

$recent_validator = new OrderRecentValidator($order_repo);

$order_proccessor = new OrderProcessor($biller, $order_repo, [$recent_validator]);

$order_proccessor->process($order);
