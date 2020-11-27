<?php

namespace Notify\Laravel\Toastr\Tests;

class NotifyToastrServiceProviderTest extends TestCase
{
    public function testContainerContainNotifyServices()
    {
        $this->assertTrue($this->app->bound('notify.producer'));
        $this->assertTrue($this->app->bound('notify.producer.toastr'));
    }

    public function testNotifyFactoryIsAddedToExtensionsArray()
    {
        $manager = $this->app->make('notify.producer');

        $reflection = new \ReflectionClass($manager);
        $property = $reflection->getProperty('drivers');
        $property->setAccessible(true);

        $extensions = $property->getValue($manager);

        $this->assertCount(1, $extensions);
        $this->assertInstanceOf('Notify\Producer\ProducerInterface', $extensions['toastr']);
    }

    public function testConfigToastrInjectedInGlobalNotifyConfig()
    {
        $manager = $this->app->make('notify.producer');

        $reflection = new \ReflectionClass($manager);
        $property = $reflection->getProperty('config');
        $property->setAccessible(true);

        $config = $property->getValue($manager);

        $this->assertArrayHasKey('toastr', $config->get('adapters'));

        $this->assertEquals(array(
            'toastr' => array('scripts' => array('jquery.js'), 'styles' => array('styles.css'), 'options' => array()),
        ), $config->get('adapters'));
    }
}
