<?php

namespace Notify\Toastr\Laravel\Tests;

class NotifyToastrServiceProviderTest extends TestCase
{
    public function test_container_contain_notify_services()
    {
        $this->assertTrue($this->app->bound('notify'));
        $this->assertTrue($this->app->bound('notify.toastr'));
    }

    public function test_notify_factory_is_added_to_extensions_array()
    {
        $manager = $this->app->make('notify');

        $reflection = new \ReflectionClass($manager);
        $property = $reflection->getProperty('extensions');
        $property->setAccessible(true);

        $extensions = $property->getValue($manager);

        $this->assertCount(1, $extensions);
        $this->assertInstanceOf('\Yoeunes\Notify\Toastr\Factory\ToastrFactory', $extensions['toastr'](array()));
    }

    public function test_config_toastr_injected_in_global_notify_config()
    {
        $manager = $this->app->make('notify');

        $reflection = new \ReflectionClass($manager);
        $property = $reflection->getProperty('config');
        $property->setAccessible(true);

        $config = $property->getValue($manager);

        $this->assertArrayHasKey('toastr', $config->get('notifiers'));

        $this->assertEquals(array(
            'toastr' => array(
                'scripts' => array('jquery.js'),
                'styles' => array('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css'),
                'options' => array(),
            ),
            'pnotify' => array('scripts' => array('jquery.js')),
        ), $config->get('notifiers'));
    }
}
