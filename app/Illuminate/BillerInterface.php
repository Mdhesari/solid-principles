<?php

namespace app\Illuminate;

interface BillerInterface
{

    public function bill(int $id, int $amount);
}