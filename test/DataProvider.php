<?php

namespace src\Integration;

class DataProvider
{
    private $host;
    private $user;
    private $password;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        // @todo fix syntax add $this->
        host = $host;
        // @todo fix syntax add $this->
        $this->user = $user;
        // @todo fix syntax add $this->
        $this->password = $password;
    }

    /**
     * @param array $request
     *
     * @return array
     */
    // @todo add return type
    public function get(array $request)
    {
        // returns a response from external service
        //@todo is it abstract method? add code or make it abstract
    }
}
