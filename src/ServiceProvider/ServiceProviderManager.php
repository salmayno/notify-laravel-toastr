<?php

namespace Notify\Toastr\Laravel\ServiceProvider;

use Notify\Toastr\Laravel\NotifyToastrServiceProvider;
use Notify\Toastr\Laravel\ServiceProvider\Providers\ServiceProviderInterface;

final class ServiceProviderManager
{
    private $provider;

    /**
     * @var ServiceProviderInterface[]
     */
    private $providers = array(
        'Yoeunes\Notify\Toastr\Laravel\ServiceProvider\Providers\Laravel4',
        'Yoeunes\Notify\Toastr\Laravel\ServiceProvider\Providers\Laravel',
        'Yoeunes\Notify\Toastr\Laravel\ServiceProvider\Providers\Lumen',
    );

    private $notifyServiceProvider;

    public function __construct(NotifyToastrServiceProvider $notifyServiceProvider)
    {
        $this->notifyServiceProvider = $notifyServiceProvider;
    }

    public function boot()
    {
        $provider = $this->resolveServiceProvider();

        $provider->publishConfig($this->notifyServiceProvider);
        $provider->mergeConfigFromToastr();
    }

    public function register()
    {
        $provider = $this->resolveServiceProvider();

        $provider->registerNotifyToastrFactory();
    }

    /**
     * @return ServiceProviderInterface
     */
    private function resolveServiceProvider()
    {
        if ($this->provider instanceof ServiceProviderInterface) {
            return $this->provider;
        }

        foreach ($this->providers as $providerClass) {
            $provider = new $providerClass($this->notifyServiceProvider->getApplication());

            if ($provider->shouldBeUsed()) {
                return $this->provider = $provider;
            }
        }

        throw new \InvalidArgumentException('Service Provider not found.');
    }
}
