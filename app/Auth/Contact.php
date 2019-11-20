<?php

namespace app\Auth;

use app\Illuminate\RemindableInterface;

class Contact extends Eloquent implements RemindableInterface
{

    public function getReminderEmail()
    {

        return $this->attributes['email'];
    }
}
