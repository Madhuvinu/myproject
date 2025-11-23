<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ApiExampleController extends Controller
{
    /**
     * Example: Fetch data from a public API
     * This fetches a sample post from JSONPlaceholder API
     */
    public function fetchApiData()
    {
        // Fetch from a free test API
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/1');
        
        if ($response->successful()) {
            $data = $response->json();
            
            // Return as JSON (or pass to view)
            return response()->json([
                'message' => 'API Data fetched successfully!',
                'data' => $data,
            ]);
        }
        
        return response()->json(['error' => 'Failed to fetch API data'], 500);
    }
    
    /**
     * Example: Display API data in a view
     */
    public function showApiInView()
    {
        // Fetch from API
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/1');
        $post = $response->json();
        
        // Pass to view
        return view('api-example', ['post' => $post]);
    }
    
    /**
     * Example: Fetch multiple posts from API
     */
    public function fetchMultiplePosts()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response->json();
        
        // Limit to first 5 for display
        $limitedPosts = array_slice($posts, 0, 5);
        
        return view('posts', ['posts' => $limitedPosts]);
    }
    
    /**
     * Example: Use database with Query Builder
     * Note: This assumes you have a 'posts' table
     */
    public function showDatabasePosts()
    {
        try {
            // Check if table exists, if not show example data
            $posts = DB::table('posts')->get();
            
            if ($posts->isEmpty()) {
                return view('database-example', [
                    'posts' => [],
                    'message' => 'No posts in database. Create a posts table first!',
                ]);
            }
            
            return view('database-example', ['posts' => $posts]);
        } catch (\Exception $e) {
            return view('database-example', [
                'posts' => [],
                'message' => 'Posts table does not exist. Check migrations!',
            ]);
        }
    }
    
    /**
     * Example: Combine API and Database
     * Fetch from API and optionally save to database
     */
    public function fetchAndSave()
    {
        // Fetch from API
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/1');
        $apiPost = $response->json();
        
        // Optionally save to database (commented out - uncomment to use)
        /*
        try {
            DB::table('posts')->insert([
                'title' => $apiPost['title'],
                'body' => $apiPost['body'],
                'user_id' => $apiPost['userId'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $message = 'Data fetched and saved to database!';
        } catch (\Exception $e) {
            $message = 'Data fetched, but could not save to database: ' . $e->getMessage();
        }
        */
        
        return view('api-database-combined', [
            'apiPost' => $apiPost,
            'message' => 'Data fetched from API successfully!',
        ]);
    }
}


