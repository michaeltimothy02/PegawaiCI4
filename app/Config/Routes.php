<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');

// AUTHENTICATION 
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');

// AREA KHUSUS LOGIN (UMUM)
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // Halaman yang bisa diakses Pegawai & Admin
    $routes->get('/dashboard', 'DashboardController::index');
    
    // Profil 
    $routes->get('profile', 'ProfileController::index');
    $routes->get('profile/edit', 'ProfileController::edit');
    $routes->post('profile/update', 'ProfileController::update');

    // AREA KHUSUS ADMIN SAJA
    
    $routes->group('', ['filter' => 'role:admin'], function($routes) {
    $routes->get('departments/edit/(:num)', 'DepartmentController::edit/$1');
    $routes->get('positions/edit/(:num)', 'PositionController::edit/$1');
    $routes->get('employees/edit/(:num)', 'EmployeeController::edit/$1');
    // ----------------------------------

    $routes->resource('departments', ['controller' => 'DepartmentController']);
    $routes->resource('positions', ['controller' => 'PositionController']);
    $routes->resource('employees', ['controller' => 'EmployeeController']);
        
        // API filter jabatan (Internal Admin)
        $routes->get('api/positions/(:num)', 'EmployeeController::getPositionsByDepartment/$1');
    });
});

// API ROUTES (KHUSUS ADMIN)

$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => null], function($routes) {
    $routes->get('employees', 'EmployeeApi::index');
    $routes->get('employees/(:num)', 'EmployeeApi::show/$1');
    $routes->post('employees', 'EmployeeApi::create');
    $routes->put('employees/(:num)', 'EmployeeApi::update/$1');
    $routes->delete('employees/(:num)', 'EmployeeApi::delete/$1');
    $routes->get('positions-by-department/(:num)', 'EmployeeApi::getPositionsByDepartment/$1');
});

// Admin Login Routes
$routes->get('/admin/login', 'AdminAuthController::login');
$routes->post('/admin/login', 'AdminAuthController::processLogin');
$routes->get('/admin/logout', 'AdminAuthController::logout');
