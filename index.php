<?php

require_once 'bootstrap.php';

use app\Order\Order;
use app\Auth\Account;

$app = new Order(5, new Account);
