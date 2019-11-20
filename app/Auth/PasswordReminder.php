<?php

namespace app\Auth;

use app\Illuminate\RemindableInterface;

/**
 * 
 * This class is only for testing and practicing
 * 
 */
class PasswordReminder
{

    public function remind(RemindableInterface $contact, $view)
    {

        echo $contact->getReminderEmail();
    }
}
