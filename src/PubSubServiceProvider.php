<?php namespace LuqmanV1\PubSub;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use LuqmanV1\PubSub\PubSub as ps;

class PubSubServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('pubsub', function () {
            return new ps;
        });
    }
}
