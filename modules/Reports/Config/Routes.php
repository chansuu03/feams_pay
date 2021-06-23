<?php

$routes->group('admin/reports', ['namespace' => 'Modules\Reports\Controllers'], function($routes){
    $routes->match(['get', 'post'], 'login', 'LoginReport::index', ["filter" => "auth"]);
    $routes->match(['get', 'post'], 'add', 'Permissions::add', ["filter" => "auth"]);
    $routes->match(['get', 'post'], 'edit/(:num)', 'Permissions::add2/$1', ["filter" => "auth"]);
});
  