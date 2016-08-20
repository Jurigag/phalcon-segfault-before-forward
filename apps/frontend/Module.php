<?php

namespace Multiple\Frontend;

use Acl;
use Phalcon\Events\Manager;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;

class Module
{
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            [
                'Multiple\Frontend\Controllers' => '../apps/frontend/controllers/',
                'Multiple\Frontend\Models' => '../apps/frontend/models/',
            ]
        );

        $loader->register();
    }

    /**
     * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
     */
    public function registerServices($di)
    {

        //Registering a dispatcher
        $di->set(
            'dispatcher',
            function () {
                $dispatcher = new Dispatcher();
                $dispatcher->setDefaultNamespace("Multiple\Frontend\Controllers\\");
                $eventsManager = new Manager();
                $eventsManager->attach(
                    'dispatch:beforeException',
                    function ($event, $dispatcher) {
                        $dispatcher->forward(
                            [
                                'controller' => 'products',
                                'action' => 'notFound',
                            ]
                        );
                        return false;
                    }
                );

                $dispatcher->setEventsManager($eventsManager);

                return $dispatcher;
            }
        );

        //Registering the view component
        $di->set(
            'view',
            function () {
                $view = new \Phalcon\Mvc\View();
                $view->setViewsDir('../apps/frontend/views/');

                return $view;
            }
        );

        $di->set(
            'db',
            function () {
                return new Database(
                    [
                        "host" => "localhost",
                        "username" => "root",
                        "password" => "secret",
                        "dbname" => "invo",
                    ]
                );
            }
        );
    }
}
