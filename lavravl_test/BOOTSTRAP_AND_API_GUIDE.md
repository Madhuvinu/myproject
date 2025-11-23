# Bootstrap & API/Database Usage Guide 🚀

## Part 1: Understanding `bootstrap/app.php` 🔧

### What is `bootstrap/app.php`?

`bootstrap/app.php` is the **configuration file** that sets up your Laravel application. Think of it as the "settings" file that tells Laravel how to behave.

### How It Connects:

```
Step 1: User makes request
   ↓
Step 2: public/index.php (Entry Point)
   ↓
Step 3: public/index.php loads bootstrap/app.php
   ↓
Step 4: bootstrap/app.php configures Laravel
   ↓
Step 5: Laravel handles the request
```

### Breaking Down `bootstrap/app.php`:

```php
return Application::configure(basePath: dirname(__DIR__))
    // ↑ Sets the base path of your application
    
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // ↑ Tells Laravel: "Your web routes are here!"
        
        commands: __DIR__.'/../routes/console.php',
        // ↑ Tells Laravel: "Your Artisan commands are here!"
        
        health: '/up',
        // ↑ Health check endpoint
    )
    
    ->withMiddleware(function (Middleware $middleware): void {
        // ↑ Configure middleware (authentication, CSRF protection, etc.)
    })
    
    ->withExceptions(function (Exceptions $exceptions): void {
        // ↑ Configure error handling
    })
    ->create();
    // ↑ Creates the application instance
```

### What It Does:

1. **Loads Routes**: Points Laravel to `routes/web.php`
2. **Configures Middleware**: Security, authentication, etc.
3. **Sets Up Exception Handling**: How errors are displayed
4. **Registers Services**: Database, mail, cache, etc.

### When Do You Modify It?

**Usually NEVER** for beginners. You only modify it to:
- Add custom middleware
- Change error handling
- Register service providers

**For now, you don't need to touch it!** ✅

---

## Part 2: Using Database 📊

### Where to Use Database?

**Best Practice**: Use in **Controllers** or **Models**

### Setup Database:

1. **Configure in `.env`**:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
```

2. **Or use SQLite** (already configured):
```env
DB_CONNECTION=sqlite
DB_DATABASE=/full/path/to/database/database.sqlite
```

### Method 1: Using Eloquent Models (Recommended) ✅

**Step 1: Create a Model**
```bash
php artisan make:model Product
```

**Step 2: Use in Controller**
```php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Get all products from database
        $products = Product::all();
        
        return view('products', ['products' => $products]);
    }
    
    public function store(Request $request)
    {
        // Create new product
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        
        return redirect('/products');
    }
}
```

**Step 3: Use in Routes**
```php
// routes/web.php
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
```

### Method 2: Using Query Builder (Direct Queries)

```php
// In a Controller or Route
use Illuminate\Support\Facades\DB;

Route::get('/users', function () {
    // Get all users
    $users = DB::table('users')->get();
    
    // Get specific user
    $user = DB::table('users')->where('id', 1)->first();
    
    // Insert data
    DB::table('users')->insert([
        'name' => 'Harsha',
        'email' => 'harsha@example.com',
    ]);
    
    // Update data
    DB::table('users')
        ->where('id', 1)
        ->update(['name' => 'Updated Name']);
    
    return view('users', ['users' => $users]);
});
```

### Example: Complete Database Usage

```php
// routes/web.php
use Illuminate\Support\Facades\DB;

// Show all posts
Route::get('/posts', function () {
    $posts = DB::table('posts')
        ->orderBy('created_at', 'desc')
        ->get();
    
    return view('posts', ['posts' => $posts]);
});

// Show single post
Route::get('/post/{id}', function ($id) {
    $post = DB::table('posts')
        ->where('id', $id)
        ->first();
    
    if (!$post) {
        abort(404);
    }
    
    return view('post', ['post' => $post]);
});
```

---

## Part 3: Using 3rd Party APIs 🌐

### Where to Use API Calls?

**Best Practice**: Use in **Controllers** or **Service Classes**

### Method 1: Using in Controllers (Simple Projects)

```php
// app/Http/Controllers/ApiController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getWeather()
    {
        // Example: OpenWeatherMap API
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => 'London',
            'appid' => env('WEATHER_API_KEY'),
        ]);
        
        $data = $response->json();
        
        return view('weather', ['weather' => $data]);
    }
    
    public function postToApi(Request $request)
    {
        // POST request to API
        $response = Http::post('https://api.example.com/data', [
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        return $response->json();
    }
}
```

### Method 2: Using in Service Classes (Better for Large Projects) ✅

**Step 1: Create Service Class**
```bash
php artisan make:class Services/WeatherService
```

**Step 2: Service Class**
```php
// app/Services/WeatherService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    private $apiKey;
    private $baseUrl = 'https://api.openweathermap.org/data/2.5';
    
    public function __construct()
    {
        $this->apiKey = env('WEATHER_API_KEY');
    }
    
    public function getWeather($city)
    {
        $response = Http::get("{$this->baseUrl}/weather", [
            'q' => $city,
            'appid' => $this->apiKey,
        ]);
        
        if ($response->successful()) {
            return $response->json();
        }
        
        return null;
    }
}
```

**Step 3: Use in Controller**
```php
// app/Http/Controllers/WeatherController.php
namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherService;
    
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }
    
    public function show($city)
    {
        $weather = $this->weatherService->getWeather($city);
        
        return view('weather', ['weather' => $weather]);
    }
}
```

**Step 4: Add Route**
```php
// routes/web.php
use App\Http\Controllers\WeatherController;

Route::get('/weather/{city}', [WeatherController::class, 'show']);
```

### Method 3: Using Directly in Routes (Quick Testing) ⚠️

**Only for testing! Not recommended for production:**

```php
// routes/web.php
use Illuminate\Support\Facades\Http;

Route::get('/api-test', function () {
    $response = Http::get('https://jsonplaceholder.typicode.com/posts/1');
    return $response->json();
});
```

### Setting Up API Keys:

**Step 1: Add to `.env`**
```env
WEATHER_API_KEY=your_api_key_here
GITHUB_API_KEY=your_github_token
```

**Step 2: Use in Code**
```php
$apiKey = env('WEATHER_API_KEY');
```

---

## Complete Example: Database + API Together 🔗

Let's create a page that:
1. Fetches data from API
2. Saves to database
3. Displays from database

```php
// app/Http/Controllers/PostController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Fetch from API and save to database
    public function fetchAndSave()
    {
        // Fetch from API
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response->json();
        
        // Save to database
        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'title' => $post['title'],
                'body' => $post['body'],
                'user_id' => $post['userId'],
                'created_at' => now(),
            ]);
        }
        
        return redirect('/posts')->with('success', 'Posts fetched and saved!');
    }
    
    // Display from database
    public function index()
    {
        $posts = DB::table('posts')->get();
        return view('posts', ['posts' => $posts]);
    }
}
```

---

## Best Practices 📋

### Database Usage:
✅ **DO:**
- Use Models for complex operations
- Use Query Builder for simple queries
- Keep database logic in Controllers or Models
- Use Migrations for database structure

❌ **DON'T:**
- Put database code in Views
- Write raw SQL without escaping
- Hardcode database credentials

### API Usage:
✅ **DO:**
- Use Service Classes for API calls
- Store API keys in `.env`
- Handle API errors
- Cache API responses when possible

❌ **DON'T:**
- Put API keys in code
- Make API calls in Views
- Ignore API errors
- Make too many API calls (rate limits!)

---

## Project Structure for API/Database:

```
app/
├── Http/
│   └── Controllers/
│       ├── ProductController.php    ← Use database here
│       └── ApiController.php        ← Use API here
├── Models/
│   └── Product.php                  ← Database model
├── Services/                        ← Create this folder
│   └── WeatherService.php           ← API service classes
└── ...
```

---

## Quick Reference Card 🎯

### Database:
```php
// Get all
DB::table('users')->get();

// Get one
DB::table('users')->where('id', 1)->first();

// Insert
DB::table('users')->insert(['name' => 'John']);

// Update
DB::table('users')->where('id', 1)->update(['name' => 'Jane']);

// Delete
DB::table('users')->where('id', 1)->delete();
```

### API:
```php
// GET request
Http::get('https://api.example.com/data');

// POST request
Http::post('https://api.example.com/data', ['key' => 'value']);

// With authentication
Http::withToken($token)->get('https://api.example.com/data');

// With headers
Http::withHeaders(['X-API-Key' => $key])->get('...');
```

---

**Need more examples? Ask me!** 🚀


