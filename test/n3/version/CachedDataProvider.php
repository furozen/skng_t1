<?php

namespace DataProvider;

use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

/**
 * Caching provider's request and implementing IDataProvider
 * Class CachedDataProvider
 * @package DataProvider
 */
class CachedDataProvider implements IDataProvider
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ICacheableDataProvider
     */
    private $provider;

    /**
     * CachedDataProvider constructor.
     * @param ICacheableDataProvider $provider
     * @param CacheItemPoolInterface $cache
     * @param LoggerInterface $logger
     */
    public function __construct(ICacheableDataProvider $provider, CacheItemPoolInterface $cache, LoggerInterface $logger)
    {
        $this->provider = $provider;
        $this->cache = $cache;
        $this->logger = $logger;
    }


    /**
     * @param array $request
     * @return array
     */

    public function getResponse(array $request):array
    {
        try {
            $cacheKey = $this->getCacheKey($request);
            $cacheItem = $this->cache->getItem($cacheKey);
            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }
        } catch (Exception $e) {
            $this->logger->warning('Cache read error:'.$e->getMessage());
        };

        $result = $this->provider->getResponse($request);
        try {
            $cacheItem
                ->set($result)
                ->expiresAt(
                    (new DateTime())->modify('+1 day')
                );
        } catch (Exception $e){
            $this->logger->warning('Cache read error:'.$e->getMessage());
        }
        return $result;

    }

    protected function getCacheKey(array $request):string
    {
        return $this->provider->getCacheKeyPrefix().hash('sha256',$request);
    }
}