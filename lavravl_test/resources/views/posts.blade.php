<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts from API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
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
        .post {
            margin: 20px 0;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
            border-left: 4px solid #667eea;
        }
        .post-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }
        .post-body {
            color: #666;
            line-height: 1.6;
        }
        .post-meta {
            color: #999;
            font-size: 12px;
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
        <h1>📋 Posts from API</h1>
        <p>These posts are fetched from JSONPlaceholder API</p>
        
        @if(isset($posts) && count($posts) > 0)
            @foreach($posts as $post)
                <div class="post">
                    <div class="post-title">{{ $post['title'] }}</div>
                    <div class="post-body">{{ Str::limit($post['body'], 150) }}</div>
                    <div class="post-meta">Post ID: {{ $post['id'] }} | User ID: {{ $post['userId'] }}</div>
                </div>
            @endforeach
        @else
            <p>No posts available</p>
        @endif
        
        <a href="/">← Back to Home</a>
    </div>
</body>
</html>


