<?php

$routes->group('discussions', ['namespace' => 'Modules\Discussions\Controllers'], function($routes){
  $routes->get('/', 'Discussions::index', ["filter" => "auth"]);
  $routes->match(['get', 'post'], 'add/(:num)', 'Discussions::add/$1', ["filter" => "auth"]);
  // $routes->match(['get', 'post'], '(:any)', 'Comments2::index/$1', ["filter" => "auth"]);
  // $routes->get('/delete/comment/(:num)', 'Comments2::delete/$1', ["filter" => "auth"]);
});


$routes->match(['get', 'post'], 'discussions/(:any)', '\Modules\Discussions\Controllers\Comments2::index/$1');
$routes->get('discuss/(:any)/comment/delete/(:num)', '\Modules\Discussions\Controllers\Comments2::delete/$1/$2');