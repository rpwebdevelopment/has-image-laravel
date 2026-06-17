<?php

namespace RPWebDevelopment\HasImageLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RPWebDevelopment\HasImageLaravel\HasImageLaravel
 */
class HasImageLaravel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RPWebDevelopment\HasImageLaravel\HasImageLaravel::class;
    }
}
