<?php

namespace app\Auth;

use app\Illuminate\RemindableInterface;
/**
 * 
 * This class is only for testing and practicing
 * 
 */

class Contact extends Eloquent implements RemindableInterface
{

    public function getReminderEmail()
    {

        return $this->attributes['email'];
    }
}
