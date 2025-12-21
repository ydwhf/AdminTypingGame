<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Auth
$routes->get('/', 'AuthController::index');
$routes->post('/loginProcess', 'AuthController::loginProcess');
$routes->get('/logout', 'AuthController::logout');

//Dashboard
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('dashboard/progress/(:num)', 'DashboardController::getProgressUser/$1');

//Skor
$routes->get('/skorSiswa', 'SkorController::index');
$routes->get('score/delete/(:num)', 'SkorController::delete/$1');

//User
$routes->get('/kelolaSiswa', 'UserController::index');
$routes->post('/user/create', 'UserController::create');
$routes->get('user/delete/(:num)', 'UserController::delete/$1');
$routes->post('/user/update/(:num)', 'UserController::update/$1');
$routes->get('user/get/(:num)', 'UserController::get/$1');

//API
$routes->post('api/login', 'ApiController::loginUser');
$routes->get('api/getUser/(:num)', 'ApiController::getUser/$1');
$routes->post('api/users/getOrCreate', 'ApiController::getOrCreate');
$routes->post('api/scores/save', 'ApiController::save');
$routes->get('api/scores/history', 'ApiController::history');
