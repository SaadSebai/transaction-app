<?php

use App\Core\Router;
use App\Http\Controllers\Api\TransactionApiController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransactionController;

/** @var Router $router */

// --- Guest ---
$router->get('/', LoginController::class, 'create')->middleware(['guest']);
$router->post('/login', LoginController::class, 'store')->middleware(['guest']);

// --- Admin ---
$router->get('/home', HomeController::class, 'index')->middleware(['auth']);
$router->post('/logout', LoginController::class, 'destroy')->middleware(['auth']);

// *** Client ***
$router->get('/clients', ClientController::class, 'index')->middleware(['auth']);
$router->get('/clients/create', ClientController::class, 'create')->middleware(['auth']);
$router->post('/clients', ClientController::class, 'store')->middleware(['auth']);
$router->get('/clients/{client}/edit', ClientController::class, 'edit')->middleware(['auth']);
$router->put('/clients/{client}', ClientController::class, 'update')->middleware(['auth']);
$router->delete('/clients/{client}', ClientController::class, 'destroy')->middleware(['auth']);

// *** Transaction ***
$router->get('/clients/{client}/transactions', TransactionController::class, 'index')->middleware(['auth']);
$router->get('/clients/{client}/transactions/create', TransactionController::class, 'create')->middleware(['auth']);
$router->post('/clients/{client}/transactions', TransactionController::class, 'store')->middleware(['auth']);

// --- Api ---
$router->get('/api/clients/{client}/transactions', TransactionApiController::class, 'index');
