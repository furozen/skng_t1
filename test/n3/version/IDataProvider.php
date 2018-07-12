<?php

namespace DataProvider;

interface IDataProvider
{
    /**
     * @param array $request
     * @return array
     */
    public function getResponse(array $request): array;
}