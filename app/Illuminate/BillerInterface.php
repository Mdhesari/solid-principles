<?php

namespace app\Illuminate;

interface BillerInterface
{

    /**
     * generate a new bill
     *
     * @param  int $id
     * @param  int $amount
     *
     * @return void
     */
    public function bill(int $id, int $amount);
}