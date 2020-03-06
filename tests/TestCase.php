<?php

namespace Yoeunes\Notify\Toastr\Laravel\Tests;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app = null)
    {
        return array(
            'Yoeunes\Notify\Laravel\NotifyServiceProvider',
            'Yoeunes\Notify\Toastr\Laravel\NotifyToastrServiceProvider',
        );
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $separator = $this->isLaravel4() ? '::config' : '';

        $app['config']->set('session'.$separator.'.driver', 'array');
        $app['config']->set('notify'.$separator.'.notifiers', array(
            'toastr' => array('scripts' => array('jquery.js')),
            'pnotify' => array('scripts' => array('jquery.js')),
        ));
    }

    private function isLaravel4()
    {
        return 0 === strpos(Application::VERSION, '4.');
    }
}
