<?php

namespace Notify\Laravel\Toastr;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Notify\Laravel\Toastr\ServiceProvider\ServiceProviderManager;

class NotifyToastrServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $manager = new ServiceProviderManager($this);
        $manager->boot();
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $manager = new ServiceProviderManager($this);
        $manager->register();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return array(
            'notify.producer',
            'notify.producer.toastr',
            'notify.renderer.toastr',
        );
    }

    /**
     * @return \Illuminate\Container\Container
     */
    public function getApplication()
    {
        return $this->app;
    }

    /**
     * {@inheritdoc}
     */
    public function mergeConfigFrom($path, $key)
    {
        parent::mergeConfigFrom($path, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function publishes(array $paths, $groups = null)
    {
        parent::publishes($paths, $groups);
    }
}
