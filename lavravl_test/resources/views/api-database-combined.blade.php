<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API + Database Combined</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        .section {
            margin: 30px 0;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        .section h2 {
            color: #667eea;
            margin-top: 0;
        }
        .info {
            background: #e8f5e9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #4caf50;
        }
        .post {
            padding: 15px;
            background: white;
            border-radius: 5px;
            margin-top: 10px;
        }
        a {
            color: #667eea;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔗 API + Database Combined Example</h1>
        
        @if(isset($message))
            <div class="info">
                ✅ {{ $message }}
            </div>
        @endif
        
        <div class="info">
            <strong>This page demonstrates:</strong><br>
            1. Fetching data from an external API<br>
            2. Processing the data<br>
            3. (Optionally) Saving to database<br>
            4. Displaying the result
        </div>
        
        @if(isset($apiPost))
            <div class="section">
                <h2>📥 Data from API:</h2>
                <div class="post">
                    <h3>{{ $apiPost['title'] }}</h3>
                    <p>{{ $apiPost['body'] }}</p>
                    <small>Post ID: {{ $apiPost['id'] }} | User ID: {{ $apiPost['userId'] }}</small>
                </div>
            </div>
            
            <div class="section">
                <h2>💾 To Save to Database:</h2>
                <p>Uncomment the database code in <code>ApiExampleController.php</code> method <code>fetchAndSave()</code></p>
                <pre style="background: #f5f5f5; padding: 10px; border-radius: 5px;">
DB::table('posts')->insert([
    'title' => $apiPost['title'],
    'body' => $apiPost['body'],
    'user_id' => $apiPost['userId'],
    'created_at' => now(),
]);
                </pre>
            </div>
        @endif
        
        <a href="/">← Back to Home</a>
    </div>
</body>
</html>


