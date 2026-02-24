<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/dashboard', 'DashboardController::index');
    $routes->resource('departments', ['controller' => 'DepartmentController']);
    $routes->resource('positions', ['controller' => 'PositionController']);

    // Employees - semua bisa akses kecuali delete
    $routes->get('employees', 'EmployeeController::index');
    $routes->get('employees/new', 'EmployeeController::new');
    $routes->post('employees', 'EmployeeController::create');
    $routes->get('employees/(:num)/edit', 'EmployeeController::edit/$1');
    $routes->post('employees/(:num)', 'EmployeeController::update/$1');

    // Delete hanya admin
    $routes->delete('employees/(:num)', 'EmployeeController::delete/$1', ['filter' => 'role:admin']);

    // Profil
    $routes->get('profile', 'ProfileController::index');
    $routes->get('profile/edit', 'ProfileController::edit');
    $routes->post('profile/update', 'ProfileController::update');

    // API filter jabatan
    $routes->get('api/positions/(:num)', 'EmployeeController::getPositionsByDepartment/$1');
});

// API Routes - Sesuai requirement
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('employees', 'EmployeeApi::index');
    $routes->get('employees/(:num)', 'EmployeeApi::show/$1');
    $routes->post('employees', 'EmployeeApi::create');
    $routes->put('employees/(:num)', 'EmployeeApi::update/$1');
    $routes->delete('employees/(:num)', 'EmployeeApi::delete/$1');
    $routes->get('positions-by-department/(:num)', 'EmployeeApi::getPositionsByDepartment/$1');
});