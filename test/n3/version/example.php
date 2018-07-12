<?php

use DataProvider\{
    UnsecureWebDataProvider,
    CachedDataProvider,
    ProxyDataProvider

};

$unsecureDP =  new UnsecureWebDataProvider('somecoolservice.com','','');
//pseudo code for Cache(CacheItemPoolInterface) and Logger(LoggerInterface) parameters
$cacheDP = new CachedDataProvider($unsecureDP, new ConcreteCachePool(), new Logger());


// in real app concrete provider will be hided by the proxy
//use without cache
$dataProvider =  new ProxyDataProvider($unsecureDP);
$data = $dataProvider->getResponse(['datetime']);

//use with cache
$dataProvider =  new ProxyDataProvider($cacheDP);
$data = $dataProvider->getResponse(['datetime']);