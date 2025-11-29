<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Auth
$routes->get('/', 'AuthController::index');
$routes->post('/loginProcess', 'AuthController::loginProcess');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard', 'DashboardController::index');

//Skor
$routes->get('/skorSiswa', 'SkorController::index');
$routes->get('score/delete/(:num)', 'SkorController::delete/$1');

$routes->get('/kelolaSiswa', 'UserController::index');

//API
$routes->post('api/users/getOrCreate', 'ApiController::getOrCreate');
$routes->post('api/scores/save', 'ApiController::save');
$routes->get('api/scores/history', 'ApiController::history');
