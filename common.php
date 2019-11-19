<?php

function dd($value)
{
    var_dump($value);

    die;
}


function now()
{

    return date('Y-M-d h:m:s');
}

function parseTime($time_stamp)
{

    $date = new DateTime($time_stamp, new DateTimeZone('Asia/Tehran'));

    return $date->getDate();
}