<?php

$routes->group('discussions', ['namespace' => 'Modules\Discussions\Controllers'], function($routes){
  $routes->get('/', 'Discussions::index', ["filter" => "auth"]);
  $routes->match(['get', 'post'], 'add/(:num)', 'Discussions::add/$1');
  $routes->match(['get', 'post'], '(:any)', 'Comments2::index/$1');
  $routes->get('manage/delete/(:num)', 'Discussions::delete/$1');
});
// $routes->group('admin/discussions', ['namespace' => 'Modules\Discussions\Controllers'], function($routes){
//   $routes->get('/', 'Discussions::index', ["filter" => "auth"]);
//   $routes->get('manage', 'Discussions::manage');
//   $routes->match(['get', 'post'], 'add', 'Discussions::add');
//   $routes->get('manage/delete/(:num)', 'Discussions::delete/$1');
// });

// $routes->group('discussions', ['namespace' => 'Modules\Discussions\Controllers'], function($routes){
//   $routes->get('/', 'Members::index');
// });

// $routes->match(['get', 'post'], 'discussions/(:any)', '\Modules\Discussions\Controllers\Comments::index/$1');
