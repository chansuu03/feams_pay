<?php

$routes->group('admin/elections', ['namespace' => 'Modules\Elections\Controllers'], function($routes){
  $routes->get('/', 'Elections::index', ["filter" => "auth"]);
  $routes->match(['get', 'post'], 'add', 'Elections::add');
  $routes->match(['get', 'post'], 'edit/(:alphanum)', 'Elections::edit/$1');
  $routes->get('delete/(:num)', 'Elections::deactivate/$1');
});

$routes->group('admin/candidates', ['namespace' => 'Modules\Elections\Controllers'], function($routes){
  $routes->get('/', 'Candidates::index');
  $routes->match(['get', 'post'], 'add', 'Candidates::add');
});

$routes->group('admin/positions', ['namespace' => 'Modules\Elections\Controllers'], function($routes){
  $routes->get('/', 'Positions::index');
  $routes->match(['get', 'post'], 'add', 'Positions::add');
  $routes->get('delete/(:num)', 'Positions::delete/$1');
});
