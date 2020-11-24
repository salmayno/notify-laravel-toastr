<?php

namespace Notify\Laravel\Toastr\ServiceProvider\Providers;

use Illuminate\Foundation\Application;
use Notify\Laravel\Toastr\NotifyToastrServiceProvider;

final class Laravel4 extends Laravel
{
    public function shouldBeUsed()
    {
        return $this->app instanceof Application && 0 === strpos(Application::VERSION, '4.');
    }

    public function publishConfig(NotifyToastrServiceProvider $provider)
    {
        $provider->package('php-notify/notify-laravel-toastr', 'notify_toastr', __DIR__.'/../../../resources');
    }

    public function mergeConfigFromToastr()
    {
        $notifyConfig = $this->app['config']->get('notify::config.adapters.toastr', array());

        $toastrConfig = $this->app['config']->get('notify_toastr::config', array());

        $this->app['config']->set('notify::config.adapters.toastr', array_merge($toastrConfig, $notifyConfig));
    }
}
