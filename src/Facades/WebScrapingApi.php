<?php
namespace WebScrapingApi\Facades;

use Illuminate\Support\Facades\Facade;

class WebScrapingApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \WebScrapingApi\Client::class;
    }
}