<?php

$routes->group('voting', ['namespace' => 'Modules\Voting\Controllers'], function($routes){
//   $routes->get('/', 'Voting::index');
  $routes->match(['get', 'post'], '/', 'Voting::index', ["filter" => "auth"]);
});
