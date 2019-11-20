<?php

namespace app\Helper;

use app\Illuminate\AuthenticateProviderInterface;

class DBProvider extends DB implements AuthenticateProviderInterface
{

    protected $table = "users";

    public function finder($id)
    {

        return $this->find('id', $id);
    }

    public function findByUsername($username)
    {

        return $this->find('username', $username);
    }

    public function findByNth($key, $value)
    {

        return $this->find($key, $value);
    }
}
