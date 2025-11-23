<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - {{ config('app.name', 'Laravel') }}</title>
            <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .welcome-container {
            text-align: center;
            padding: 2rem;
        }
        h1 {
            font-size: 3rem;
            margin: 0;
            font-weight: 300;
            letter-spacing: 2px;
        }
        .name {
            font-weight: 600;
            color: #ffd700;
        }
            </style>
    </head>
<body>
    <div class="welcome-container">
        <h1>Welcome <span class="name">Harsha</span></h1>
        </div>
    </body>
</html>
