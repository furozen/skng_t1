<?php

namespace src\Integration;

abstract class DataProvider
{
    protected $host;
    protected $user;
    protected $password;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $request
     * @return array
     */
    abstract public function get(array $request):array;

    abstract public function getCacheKeyPrefix():string;

}
