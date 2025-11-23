<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiExampleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Product;

// ========================================
// AUTHENTICATION ROUTES
// ========================================

// Homepage - E-commerce landing page
Route::get('/', function (Request $request) {
    $query = Product::where('is_active', true);
    
    // If search parameter exists, filter products
    if ($request->has('search') && $request->search) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'like', '%' . $searchTerm . '%')
              ->orWhere('description', 'like', '%' . $searchTerm . '%')
              ->orWhere('category', 'like', '%' . $searchTerm . '%');
        });
    }
    
    $products = $query->latest()->take(12)->get();
    $cartCount = auth()->check() ? auth()->user()->cartItems->sum('quantity') : 0;
    return view('homepage', compact('products', 'cartCount'));
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

// ========================================
// PRODUCT ROUTES
// ========================================
Route::get('/products', function () {
    $products = Product::where('is_active', true)->paginate(12);
    return view('products.index', compact('products'));
})->name('products.index');

Route::get('/products/{product}', function (Product $product) {
    return view('products.show', compact('product'));
})->name('products.show');

// ========================================
// CART ROUTES (Authenticated)
// ========================================
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
});

// ========================================
// CHECKOUT ROUTES (Authenticated)
// ========================================
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/orders/{order}', function (\App\Models\Order $order) {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        $order->load('orderItems.product');
        return view('orders.show', compact('order'));
    })->name('orders.show');
});

// ========================================
// ADMIN ROUTES (Admin Only)
// ========================================
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Products Management
    Route::resource('products', ProductController::class);
    
    // Orders Management
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
    // Users Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
});
