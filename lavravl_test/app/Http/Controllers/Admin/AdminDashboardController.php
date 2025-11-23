<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_products' => Product::count(),
            'low_stock_products' => Product::where('stock_quantity', '<', 10)->count(),
            'total_revenue' => Order::where('status', '!=', 'cancelled')->sum('total_amount'),
        ];

        $recent_orders = Order::with('user')->latest()->take(10)->get();
        $recent_users = User::where('role', 'user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'recent_users'));
    }
}
