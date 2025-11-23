@extends('admin.layout')

@section('title', 'Orders')
@section('page-title', 'Order Management')

@section('content')
<div class="content-card">
    <h2>All Orders</h2>
    
    <table>
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->user->email }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge badge-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'info')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                    <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary">View Details</a></td>
                </tr>
            @empty
                <tr><td colspan="7">No orders found.</td></tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $orders->links() }}
    </div>
</div>
@endsection

