<?php

$routes->group('admin/elections', ['namespace' => 'Modules\Elections\Controllers'], function($routes){
  $routes->get('/', 'Elections2::index', ["filter" => "auth"]);
  $routes->match(['get', 'post'], 'add', 'Elections2::add', ["filter" => "auth"]);
  $routes->match(['get', 'post'], 'edit/(:alphanum)', 'Elections2::edit/$1', ["filter" => "auth"]);
  $routes->get('delete/(:num)', 'Elections2::deactivate/$1', ["filter" => "auth"]);
  $routes->get('(:num)', 'Elections2::info/$1', ["filter" => "auth"]);
//   $routes->get('(:num)/pdf', 'Elections2::generatePDF/$1', ["filter" => "auth"]);
  $routes->get('(:num)/pdf', 'Elections2::pdf/$1', ["filter" => "auth"]);
});

$routes->group('admin/candidates', ['namespace' => 'Modules\Elections\Controllers'], function($routes){
  $routes->get('/', 'Candidates2::index', ["filter" => "auth"]);
  $routes->match(['get', 'post'], 'add', 'Candidates2::add', ["filter" => "auth"]);
  $routes->get('delete/(:num)', 'Candidates2::delete/$1', ["filter" => "auth"]);
  $routes->get('elec/(:num)', 'Candidates2::other/$1', ["filter" => "auth"]);
  $routes->get('election/(:num)', 'Candidates2::tables/$1', ["filter" => "auth"]);
});

$routes->group('admin/positions', ['namespace' => 'Modules\Elections\Controllers'], function($routes){
  $routes->get('/', 'Positions2::index', ["filter" => "auth"]);
  $routes->match(['get', 'post'], 'add', 'Positions2::add', ["filter" => "auth"]);
  $routes->get('delete/(:num)', 'Positions2::delete/$1', ["filter" => "auth"]);
  $routes->get('elec/(:num)', 'Positions2::other/$1', ["filter" => "auth"]);
});
