<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrewm
 * Date: 12.07.2018
 * Time: 10:58
 */

namespace DataProvider;

/**
 * Silly example of webdata provider
 * Class UnsecureWebDataProvider
 * @package DataProvider
 */
class UnsecureWebDataProvider extends AbstractWebDataProvider implements IDataProvider
{


    public function getResponse(array $request): array
    {
        return file_get_contents('http://'.$request);
    }

    public function getCacheKeyPrefix(): string
    {
        return $this->host.'_';
    }

}