<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrewm
 * Date: 12.07.2018
 * Time: 10:54
 */

namespace DataProvider;

interface ICacheableDataProvider extends IDataProvider
{

    /**
     * return prefix for use in cache key
     * @return string
     */
    public function getCacheKeyPrefix(): string;
}