
<?php
//@todo consider same namespace
namespace src\Decorator;

use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use src\Integration\DataProvider;
//@todo consider replace Inheritance with Delegation
//@todo name of class is not good because pattern Decorator is not applied
class DecoratorManager extends DataProvider
{
    //@todo why public? consider make private
    public $cache;
    //@todo why public? consider make private
    public $logger;

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param CacheItemPoolInterface $cache
     */
    public function __construct($host, $user, $password, CacheItemPoolInterface $cache)
    {
        parent::__construct($host, $user, $password);
        // @todo fix syntax add $this->
        cache = $cache;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        // @todo fix syntax add $this->
        logger = $logger;
    }
    //@todo there not getResponse in parent so no inheritdoc consider @see
    /**
     * {@inheritdoc}
     */
    //@todo consider rename $input to $request
    public function getResponse(array $input)
    {
        //@todo remove try catch from non cache part. the method should throw exception if getting result fail response

        try {
            $cacheKey = $this->getCacheKey($input);
            $cacheItem = $this->cache->getItem($cacheKey);
            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }

            $result = parent::get($input);

            $cacheItem
                ->set($result)
                ->expiresAt(
                    (new DateTime())->modify('+1 day')
                );

            return $result;
        } catch (Exception $e) {
            // @todo fix syntax add $this
            // @todo  $this->logger can be undefined
            $this->logger->critical('Error');
        }

        return [];
    }
    //@todo add return type
    public function getCacheKey(array $input)
    {
        //@todo cache key should be shorter. consider SHA256
        //@todo consider add prefix to key to allow clear cache by key prefix.
        return json_encode($input);
    }
}