<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f5f5; }
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #1a1a1a; color: white; padding: 20px; position: fixed; height: 100vh; overflow-y: auto; }
        .sidebar h2 { margin-bottom: 30px; color: #d4af37; }
        .sidebar ul { list-style: none; }
        .sidebar li { margin-bottom: 10px; }
        .sidebar a { color: white; text-decoration: none; padding: 10px; display: block; border-radius: 5px; transition: background 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #333; }
        .main-content { margin-left: 250px; flex: 1; padding: 30px; }
        .header { background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header h1 { margin: 0; }
        .content-card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .btn { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn:hover { opacity: 0.9; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        table th { background: #f8f9fa; font-weight: 600; }
        .alert { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .stat-card h3 { color: #666; font-size: 14px; margin-bottom: 10px; }
        .stat-card .value { font-size: 32px; font-weight: bold; color: #333; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .form-group textarea { min-height: 100px; }
        .badge { padding: 5px 10px; border-radius: 3px; font-size: 12px; font-weight: 600; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a></li>
                <li><a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">Orders</a></li>
                <li><a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Users</a></li>
                <li><a href="{{ route('admin.about-us.index') }}" class="{{ request()->routeIs('admin.about-us.*') ? 'active' : '' }}">About Us</a></li>
                <li><a href="/" target="_blank">View Site</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: white; cursor: pointer; width: 100%; text-align: left; padding: 10px;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>@yield('page-title', 'Admin Dashboard')</h1>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            
            @yield('content')
        </div>
    </div>
</body>
</html>

