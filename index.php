<?php

require_once 'bootstrap.php';

use app\Auth\Authenticator;
use app\Auth\Contact;
use app\Auth\PasswordReminder;
use app\Helper\DBProvider;

/* use app\Order\Order;
use app\Order\OrderProcessor;
use app\Order\Repository\DatabaseRepository;
use app\Order\OrderBiller;
use app\Auth\Account;

use app\Order\Validators\OrderRecentValidator;

$account = new Account;

$order = new Order(5, $account);

$order_repo = new DatabaseRepository;

$biller = new OrderBiller(1, 5);

$recent_validator = new OrderRecentValidator($order_repo);

$order_proccessor = new OrderProcessor($biller, $order_repo, [$recent_validator]);

$order_proccessor->process($order); */

$authProvider = new DBProvider;

$authenticator = new Authenticator($authProvider);

$authenticator->authenticate(32);