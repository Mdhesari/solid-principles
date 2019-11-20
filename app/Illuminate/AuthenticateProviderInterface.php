<?php

namespace app\Illuminate;

interface AuthenticateProviderInterface
{

    /**
     * finder
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function finder($id);

    /**
     * findByUsername
     *
     * @param  mixed $username
     *
     * @return void
     */
    public function findByUsername($username);

    /**
     * findByNth
     *
     * @param  mixed $key
     * @param  mixed $value
     *
     * @return void
     */
    public function findByNth($key, $value);
}
