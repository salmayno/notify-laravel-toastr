<?php

namespace Yoeunes\Notify\Toastr\Laravel\ServiceProvider\Providers;

use Laravel\Lumen\Application;
use Yoeunes\Notify\Toastr\Laravel\NotifyToastrServiceProvider;

final class Lumen extends Laravel
{
    public function shouldBeUsed()
    {
        return $this->app instanceof Application;
    }

    public function publishConfig(NotifyToastrServiceProvider $provider)
    {
        $source = realpath($raw = __DIR__.'/../../../resources/config/config.php') ?: $raw;

        $this->app->configure('notify_toastr');

        $provider->mergeConfigFrom($source, 'notify_toastr');
    }
}
