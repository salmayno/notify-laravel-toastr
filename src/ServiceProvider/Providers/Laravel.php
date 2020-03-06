<?php

namespace Yoeunes\Notify\Toastr\Laravel\ServiceProvider\Providers;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application;
use Yoeunes\Notify\NotifyManager;
use Yoeunes\Notify\Toastr\Factory\ToastrFactory;
use Yoeunes\Notify\Toastr\Laravel\NotifyToastrServiceProvider;

class Laravel implements ServiceProviderInterface
{
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function shouldBeUsed()
    {
        return $this->app instanceof Application;
    }

    public function publishConfig(NotifyToastrServiceProvider $provider)
    {
        $source = realpath($raw = __DIR__.'/../../../resources/config/config.php') ?: $raw;

        $provider->publishes(array($source => config_path('notify_toastr.php')), 'config');

        $provider->mergeConfigFrom($source, 'notify_toastr');
    }

    public function registerNotifyToastrFactory()
    {
        $this->app->bind('notify.toastr', function (Container $app) {
            return new ToastrFactory();
        });

        $this->app->alias('notify.toastr', '\Yoeunes\Notify\Toastr\Factory\ToastrFactory');

        $this->app->extend('notify', function (NotifyManager $manager, Container $app) {
            $manager->extend('toastr', $app['notify.toastr']);

            return $manager;
        });
    }

    public function mergeConfigFromToastr()
    {
        $notifyConfig = $this->app['config']->get('notify.notifiers.toastr', array());

        $toastrConfig = $this->app['config']->get('notify_toastr', array());

        $this->app['config']->set('notify.notifiers.toastr', array_merge($toastrConfig, $notifyConfig));
    }
}
