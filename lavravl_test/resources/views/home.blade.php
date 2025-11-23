<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - {{ config('app.name', 'Laravel') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .user-name {
            font-weight: 600;
            color: #ffd700;
        }
        .logout-btn {
            padding: 0.5rem 1.5rem;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }
        .welcome-section {
            text-align: center;
            padding: 3rem 0;
        }
        .welcome-section h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 300;
        }
        .welcome-section p {
            font-size: 1.25rem;
            opacity: 0.9;
        }
        .content-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        .content-card h3 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        .content-card p {
            line-height: 1.6;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name', 'Laravel') }}</h1>
        <div class="user-info">
            <span>Welcome, <span class="user-name">{{ Auth::user()->name }}</span></span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="welcome-section">
            <h2>Welcome to Your Home Screen</h2>
            <p>You have successfully logged in!</p>
        </div>

        <div class="content-card">
            <h3>User Information</h3>
            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Member since:</strong> {{ Auth::user()->created_at->format('F Y') }}</p>
        </div>
    </div>
</body>
</html>

