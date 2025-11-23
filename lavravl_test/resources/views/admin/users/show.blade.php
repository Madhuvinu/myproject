@extends('admin.layout')

@section('title', 'User Details')
@section('page-title', 'User: ' . $user->name)

@section('content')
<div class="content-card">
    <div style="margin-bottom: 30px;">
        <h3>User Information</h3>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Registered:</strong> {{ $user->created_at->format('M d, Y H:i') }}</p>
        <p><strong>Total Orders:</strong> {{ $user->orders->count() }}</p>
    </div>
    
    <div>
        <h3>Order History</h3>
        @if($user->orders->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <span class="badge badge-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'delivered' ? 'success' : 'info') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No orders yet.</p>
        @endif
    </div>
    
    <div style="margin-top: 20px;">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back to Users</a>
    </div>
</div>
@endsection

