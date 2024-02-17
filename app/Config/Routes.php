<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login 
$routes->get('/', 'LoginController::index', ['filter' => 'session']);
$routes->get('/teste', 'Teste::index', ['filter' => 'session']);


// users
//$routes->get('/settings', 'SettingController::index', ['filter' => 'session']);
$routes->get('/settings', 'SettingController::index', ['filter' => 'session']);
$routes->get('/settings/delete', 'SettingController::delete', ['filter' => 'session']);

$routes->get('/list', 'UsuarioController::list', ['filter' => 'session']);
$routes->post('/edit', 'UsuarioController::edit', ['filter' => 'session']);
$routes->post('/create', 'UsuarioController::create', ['filter' => 'session']);

// company
$routes->get('/company', 'CompanyController::index', ['filter' => 'session']);
$routes->post('/company/save', 'CompanyController::save', ['filter' => 'session']);
$routes->get('/company/edit', 'CompanyController::edit', ['filter' => 'session']);
$routes->post('/company/update', 'CompanyController::update', ['filter' => 'session']);

// predios
$routes->get('/predio', 'PredioController::index', ['filter' => 'session']);
$routes->post('/predio/save', 'PredioController::save', ['filter' => 'session']);
$routes->get('/predio/edit', 'PredioController::edit', ['filter' => 'session']);
$routes->post('/predio/update', 'PredioController::update', ['filter' => 'session']);

// salas
$routes->get('/sala', 'SalaController::index', ['filter' => 'session']);
$routes->post('/sala/save', 'SalaController::save', ['filter' => 'session']);
$routes->get('/sala/edit', 'SalaController::edit', ['filter' => 'session']);
$routes->post('/sala/update', 'SalaController::update', ['filter' => 'session']);

// contratos
$routes->get('/contrato', 'ContratoController::index', ['filter' => 'session']);
$routes->post('/contrato/save', 'ContratoController::save', ['filter' => 'session']);
$routes->get('/contrato/view', 'ContratoController::view', ['filter' => 'session']);
// clientes
$routes->get('/cliente', 'ClienteController::index', ['filter' => 'session']);
$routes->post('/cliente/save', 'ClienteController::save', ['filter' => 'session']);

// permissions
$routes->get('/permissions/listUserPermission', 'PermissionsController::listUserPermission', ['filter' => 'session']);
$routes->post('/permissions/save', 'PermissionsController::save', ['filter' => 'session']);

// user permissions
$routes->post('/userPermissions/save', 'UserPermissionsController::save', ['filter' => ['session', 'permission:manage_settings']]);

// pages permissions
$routes->get('/permissionsPages/listPagesPermissions', 'PermissionsPagesController::listPagesPermissions', ['filter' => 'session']);
$routes->post('/permissionsPages/save', 'PermissionsPagesController::save', ['filter' => 'session']);

service('auth')->routes($routes);
