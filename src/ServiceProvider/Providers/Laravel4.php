<?php

namespace Yoeunes\Notify\Toastr\Laravel\ServiceProvider\Providers;

use Illuminate\Foundation\Application;
use Yoeunes\Notify\Toastr\Laravel\NotifyToastrServiceProvider;

final class Laravel4 extends Laravel
{
    public function shouldBeUsed()
    {
        return $this->app instanceof Application && 0 === strpos(Application::VERSION, '4.');
    }

    public function publishConfig(NotifyToastrServiceProvider $provider)
    {
        $provider->package('yoeunes/notify-laravel-toastr', 'notify_toastr', __DIR__.'/../../../resources');
    }
}
