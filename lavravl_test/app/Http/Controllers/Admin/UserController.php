<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::where('role', 'user')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->load('orders');
        return view('admin.users.show', compact('user'));
    }
}
