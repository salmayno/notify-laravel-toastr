<?php

namespace Yoeunes\Notify\Toastr\Laravel;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Yoeunes\Notify\Laravel\Session\Session;
use Yoeunes\Notify\NotifyManager;
use Yoeunes\Notify\Toastr\Factories\ToastrFactory;

class NotifyToastrServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerToastrFactory();
    }

    public function registerToastrFactory()
    {
        $this->app->extend('notify', function (NotifyManager $manager, Application $app) {
            $session = $app['session'];

            $manager->extend('toastr', function ($config) use ($session) {
                return new ToastrFactory($config, new Session($session));
            });

            return $manager;
        });
    }
}
