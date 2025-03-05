<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login 
$routes->get('/', 'LoginController::index', ['filter' => 'session']);
$routes->get('/teste', 'Teste::index', ['filter' => 'session']);

// ajax dashboard
$routes->get('/dashboard/dados-por-mes/entrada', 'DashboardController::dadosPorMesEntrada', ['filter' => 'session']);
$routes->get('/dashboard/dados-por-mes/saida', 'DashboardController::dadosPorMesSaida', ['filter' => 'session']);
$routes->get('/dashboard/dados-por-mes/saida/por-predio', 'DashboardController::dadosPorMesSaidaPorPredio', ['filter' => 'session']);
$routes->get('/dashboard/dados-por-mes/saida/por-predio/view', 'DashboardController::viewDadosPorMesSaidaPorPredio', ['filter' => 'session']);
$routes->get('/predio/listar-predio-por-empresa', 'PredioController::listarPredioPorEmpresa');


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
$routes->get('/contrato/edit', 'ContratoController::edit', ['filter' => 'session']);
$routes->post('/contrato/update', 'ContratoController::update', ['filter' => 'session']);

// clientes
$routes->get('/cliente', 'ClienteController::index', ['filter' => 'session']);
$routes->post('/cliente/save', 'ClienteController::save', ['filter' => 'session']);
$routes->get('/cliente/edit', 'ClienteController::edit', ['filter' => 'session']);
$routes->post('/cliente/update', 'ClienteController::update', ['filter' => 'session']);

// permissions
$routes->get('/permissions/listUserPermission', 'PermissionsController::listUserPermission', ['filter' => 'session']);
$routes->post('/permissions/save', 'PermissionsController::save', ['filter' => 'session']);

// user permissions
$routes->post('/userPermissions/save', 'UserPermissionsController::save', ['filter' => ['session', 'permission:manage_settings']]);

// pages permissions
$routes->get('/permissionsPages/listPagesPermissions', 'PermissionsPagesController::listPagesPermissions', ['filter' => 'session']);
$routes->post('/permissionsPages/save', 'PermissionsPagesController::save', ['filter' => 'session']);

// NOTAS FISCAIS
//Entrada
$routes->get('/notas-fiscais/entrada', 'NotasFiscaisController::entrada', ['filter' => 'session']);
$routes->post('/nota-fiscal/entrada/save', 'NotasFiscaisController::saveEntrada', ['filter' => 'session']);
$routes->get('/notas-fiscais/view-documento-entrada', 'NotasFiscaisController::viewDocumentoEntrada', ['filter' => 'session']);

//Saida
$routes->get('/notas-fiscais/saida', 'NotasFiscaisController::saida', ['filter' => 'session']);
$routes->post('/notas-fiscais/saida/save', 'NotasFiscaisController::saveSaida', ['filter' => 'session']);
$routes->get('/notas-fiscais/view-documento-saida', 'NotasFiscaisController::viewDocumentoSaida', ['filter' => 'session']);
$routes->get('/notas-fiscais/saida/edit', 'NotasFiscaisController::notasFiscaisSaidaEdit', ['filter' => 'session']);
$routes->post('/notas-fiscais/saida/update', 'NotasFiscaisController::notasFiscaisSaidaUpdate', ['filter' => 'session']);

//Saida - Buscar Dados por ajax
$routes->get('/lancamentos/saida/busca-sala-por-predio', 'NotasFiscaisController::buscaSalaPorPredio', ['filter' => 'session']);

// SERVIÇOS
$routes->get('/servicos/index', 'ServicosController::index', ['filter' => 'session']);
$routes->post('/servicos/save', 'ServicosController::save', ['filter' => 'session']);
$routes->get('/servicos/edit', 'ServicosController::edit', ['filter' => 'session']);
$routes->post('/servicos/edit/save', 'ServicosController::editSave', ['filter' => 'session']);

// PRESTADOR
$routes->get('/prestador/index', 'PrestadorController::index', ['filter' => 'session']);
$routes->post('/prestador/save', 'PrestadorController::save', ['filter' => 'session']);
$routes->get('/prestador/edit', 'PrestadorController::edit', ['filter' => 'session']);
$routes->post('/prestador/edit/save', 'PrestadorController::editSave', ['filter' => 'session']);


// AREA DE REGISTRO DE PONTO
$routes->get('registro-ponto/index', 'RegistroPontoController::index', ['filter' => 'session']);
$routes->post('registro-ponto/registrar', 'RegistroPontoController::registrar', ['filter' => 'session']);
$routes->get('registro-ponto/listar-predio-por-empresa', 'PredioController::listarPredioPorEmpresa', ['filter' => 'session']);
$routes->get('registro-ponto/consultar-registros', 'RegistroPontoController::consultar', ['filter' => 'session']);
$routes->get('registro-ponto/consultar-registros/detalhes', 'RegistroPontoController::consultar_detalhes', ['filter' => 'session']);
$routes->get('registro-ponto/consultar-registros/filtro', 'RegistroPontoController::filtro', ['filter' => 'session']);
$routes->get('registro-ponto/delete/(:num)', 'RegistroPontoController::delete/$1', ['filter' => 'session']);

// SUPERVISOR
$routes->get('supervisor/verifica-supervisor', 'SupervisorController::verifica_supervisor', ['filter' => 'session']);
$routes->get('supervisor/validar-senha', 'SupervisorController::validar_senha', ['filter' => 'session']);

// FUNCIONÁRIO
$routes->get('funcionario/index', 'FuncionarioController::index', ['filter' => 'session']);
$routes->get('funcionario/verificar-cpf', 'FuncionarioController::verificar_cpf', ['filter' => 'session']);
$routes->get('funcionario/cadastrar', 'FuncionarioController::formulario_cadastro', ['filter' => 'session']);
$routes->post('funcionario/cadastrar', 'FuncionarioController::cadastrar', ['filter' => 'session']);
$routes->get('funcionario/editar', 'FuncionarioController::formulario_editar', ['filter' => 'session']);
$routes->post('funcionario/editar', 'FuncionarioController::editar', ['filter' => 'session']);

service('auth')->routes($routes);
