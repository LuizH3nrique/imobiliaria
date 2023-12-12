<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login 
$routes->get('/', 'LoginController::index');
$routes->get('/teste', 'Teste::index', ['filter' => 'session']);


// users
$routes->get('/settings', 'SettingController::index', ['filter' => 'session']);
$routes->get('/list', 'UsuarioController::list', ['filter' => 'session']);
$routes->post('/edit', 'UsuarioController::edit', ['filter' => 'session']);
$routes->post('/create', 'UsuarioController::create', ['filter' => 'session']);

// company
$routes->get('/company', 'CompanyController::index', ['filter' => 'session']);

service('auth')->routes($routes);



