<?php

namespace Drupal\ae\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
* Listens to the dynamic route events.
*/
class RouteSubscriber extends RouteSubscriberBase {

    /**
    * {@inheritdoc}
    */
    protected function alterRoutes(RouteCollection $collection) {

        // Change path '/user/login' to '/ae-connect'.
        if ($route = $collection->get('user.login')) {
            $route->setPath('/ae-connect');
        }
        // Change path '/user/register' to '/ae-connect'.
        if ($route = $collection->get('user.register')) {
            $route->setPath('/ae-connect');
        }

    }

}