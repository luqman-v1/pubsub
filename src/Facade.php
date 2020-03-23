<?php namespace LuqmanV1\PubSub;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'pubsub';
    }
}
