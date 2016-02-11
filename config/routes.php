<?php
use Cake\Routing\Router;

Router::plugin(
    'Acl',
    ['path' => '/acl'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
        $routes->connect('/',['controller' => 'Permissions', 'action' => 'index']);
    }
);

Router::scope('/users/:action', ['plugin' => 'Acl'],function ($routes) {
    $routes->connect('/', ['controller' => 'Users']);
});
