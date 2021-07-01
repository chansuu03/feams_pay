<?php

$routes->group('admin/reports', ['namespace' => 'Modules\Reports\Controllers'], function($routes){
    $routes->match(['get', 'post'], 'login', 'LoginReport::index', ["filter" => "auth"]);
});
  