<?php

namespace Notify\Toastr\Laravel\ServiceProvider\Providers;

use Notify\Toastr\Laravel\NotifyToastrServiceProvider;

interface ServiceProviderInterface
{
    public function shouldBeUsed();

    public function publishConfig(NotifyToastrServiceProvider $provider);

    public function registerNotifyToastrFactory();

    public function mergeConfigFromToastr();
}
