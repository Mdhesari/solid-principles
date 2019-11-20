<?php

namespace app\Auth;

use app\Illuminate\RemindableInterface;

class PasswordReminder
{

    public function remind(RemindableInterface $contact, $view)
    {

        echo $contact->getReminderEmail();
    }
}
