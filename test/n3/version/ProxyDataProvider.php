<?php

namespace DataProvider;
/**
 * Class ProxyDataProvider
 * @package DataProvider
 */
class ProxyDataProvider implements IDataProvider
{
    /**
     * @var IDataProvider
     */
    protected $concreteProvider;

    public function __construct(IDataProvider $provider){
        $this->concreteProvider = $provider;
    }

    /**
     * @param array $request
     * @return array
     */
    public function getResponse(array $request): array
    {
        return $this->concreteProvider->getResponse($request);
    }



}