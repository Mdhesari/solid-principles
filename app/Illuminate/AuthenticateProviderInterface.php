<?php

namespace app\Illuminate;

interface AuthenticateProviderInterface
{

    public function finder($id);

    public function findByUsername($username);

    public function findByNth($key, $value);
}
