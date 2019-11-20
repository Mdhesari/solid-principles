<?php

namespace app\Auth;

use app\Illuminate\AuthenticateProviderInterface;

class Authenticator
{

    public function __construct(AuthenticateProviderInterface $authProvider)
    {

        $this->authProvider = $authProvider;
    }

    public function authenticate($id)
    {

        $user = $this->authProvider->finder($id);

        if ($user === false) {

            throw new Exception('User not found...');
        }

        dd("Welcome {$user->name}");
    }
}
