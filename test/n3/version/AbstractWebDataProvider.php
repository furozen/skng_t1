<?php

namespace DataProvider;
/**
 * Base class for web data provider
 * Class AbstractWebDataProvider
 * @package DataProvider
 */
abstract class AbstractWebDataProvider implements ICacheableDataProvider
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
    abstract public function getResponse(array $request):array;

    /**
     * @inheritdoc
     */
    abstract public function getCacheKeyPrefix():string;

}
