<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiExampleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ========================================
// AUTHENTICATION ROUTES
// ========================================

// Homepage - E-commerce landing page
Route::get('/', function () {
    return view('homepage');
});

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ========================================
// PUBLIC ROUTES
// ========================================

// Homepage route - shows welcome page (for non-authenticated users)
Route::get('/welcome', function () {
    return view('welcome');
});

// Example: About page route
Route::get('/about', function () {
    return view('about');
});

// Example: Route with parameter
Route::get('/user/{name}', function ($name) {
    return view('user', ['name' => $name]);
});

// Example: Slider page route
Route::get('/slider', function () {
    return view('slider');
});

// ========================================
// API EXAMPLES - Testing 3rd Party APIs
// ========================================

// Example 1: Fetch API data and return as JSON
Route::get('/api/test', [ApiExampleController::class, 'fetchApiData']);

// Example 2: Fetch API data and display in view
Route::get('/api/example', [ApiExampleController::class, 'showApiInView']);

// Example 3: Fetch multiple posts from API
Route::get('/api/multiple', [ApiExampleController::class, 'fetchMultiplePosts']);

// Example 4: Fetch from API and save to database
Route::get('/api/fetch-save', [ApiExampleController::class, 'fetchAndSave']);

// ========================================
// DATABASE EXAMPLES
// ========================================

// Example: Display data from database
Route::get('/database/example', [ApiExampleController::class, 'showDatabasePosts']);
