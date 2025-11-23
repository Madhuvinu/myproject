@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Users</h3>
        <div class="value">{{ $stats['total_users'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Orders</h3>
        <div class="value">{{ $stats['total_orders'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Pending Orders</h3>
        <div class="value">{{ $stats['pending_orders'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Products</h3>
        <div class="value">{{ $stats['total_products'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Low Stock Products</h3>
        <div class="value">{{ $stats['low_stock_products'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Revenue</h3>
        <div class="value">${{ number_format($stats['total_revenue'], 2) }}</div>
    </div>
</div>

<div class="content-card">
    <h2>Recent Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent_orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge badge-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'delivered' ? 'success' : 'info') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary">View</a></td>
                </tr>
            @empty
                <tr><td colspan="6">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="content-card" style="margin-top: 30px;">
    <h2>Recent Users</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registered</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent_users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td><a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary">View</a></td>
                </tr>
            @empty
                <tr><td colspan="4">No users yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

