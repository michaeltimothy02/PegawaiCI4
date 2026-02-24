<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');

// --- AUTHENTICATION ---
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');

// --- AREA KHUSUS LOGIN (UMUM) ---
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // Halaman yang bisa diakses Pegawai & Admin
    $routes->get('/dashboard', 'DashboardController::index');
    
    // Profil (Bisa diakses siapapun yang login)
    $routes->get('profile', 'ProfileController::index');
    $routes->get('profile/edit', 'ProfileController::edit');
    $routes->post('profile/update', 'ProfileController::update');

    // --- AREA KHUSUS ADMIN SAJA ---
    // Semua yang ada di dalam group ini hanya bisa diakses role:admin
    $routes->group('', ['filter' => 'role:admin'], function($routes) {
        $routes->resource('departments', ['controller' => 'DepartmentController']);
        $routes->resource('positions', ['controller' => 'PositionController']);
        
        // Employees Management (Full Akses Admin)
        $routes->resource('employees', ['controller' => 'EmployeeController']);
        
        // API filter jabatan (Internal Admin)
        $routes->get('api/positions/(:num)', 'EmployeeController::getPositionsByDepartment/$1');
    });
});

// --- API ROUTES (KHUSUS ADMIN) ---
// Jangan biarkan API terbuka tanpa filter, tambahkan filter auth & admin
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
