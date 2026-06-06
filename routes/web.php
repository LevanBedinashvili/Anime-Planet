<?php

use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\CatalogController;
use App\Controllers\DetailsController;
use App\Controllers\RandomController;
use App\Controllers\ScheduleController;
use App\Controllers\ProfileController;
use App\Controllers\AuthController;

/**
 * Web Routes
 *
 * Define all application routes here. Each route maps a URI pattern
 * to a Closure or a [Controller::class, 'method'] array.
 */

// Public Pages
Router::get('/', [HomeController::class, 'index']);
Router::get('/catalog', [CatalogController::class, 'index']);
Router::get('/details/{id}', [DetailsController::class, 'show']);
Router::get('/random', [RandomController::class, 'index']);
Router::get('/schedule', [ScheduleController::class, 'index']);

// Authentication Pages
Router::get('/login', [AuthController::class, 'showLogin']);
Router::post('/login', [AuthController::class, 'login']);
Router::get('/signup', [AuthController::class, 'showSignup']);
Router::post('/signup', [AuthController::class, 'signup']);
Router::post('/logout', [AuthController::class, 'logout']);

// User Pages (Require auth in Controller/Middleware)
Router::get('/profile', [ProfileController::class, 'index']);

// API Endpoints
Router::post('/api/watchlist/add', [ProfileController::class, 'addToWatchlist']);
Router::post('/api/watchlist/remove', [ProfileController::class, 'removeFromWatchlist']);
