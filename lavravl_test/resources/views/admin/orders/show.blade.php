@extends('admin.layout')

@section('title', 'Order Details')
@section('page-title', 'Order #' . $order->order_number)

@section('content')
<div class="content-card">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
        <div>
            <h3>Customer Information</h3>
            <p><strong>Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
        </div>
        <div>
            <h3>Order Information</h3>
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
            <p><strong>Status:</strong> 
                <span class="badge badge-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'info')) }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
        </div>
    </div>
    
    <div style="margin-bottom: 30px;">
        <h3>Shipping Address</h3>
        <p>{{ $order->shipping_address }}</p>
    </div>
    
    @if($order->notes)
    <div style="margin-bottom: 30px;">
        <h3>Notes</h3>
        <p>{{ $order->notes }}</p>
    </div>
    @endif
    
    <div style="margin-bottom: 30px;">
        <h3>Order Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
                <tr style="font-weight: bold;">
                    <td colspan="3" style="text-align: right;">Total:</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div>
        <h3>Update Order Status</h3>
        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" style="display: flex; gap: 10px; align-items: center;">
            @csrf
            @method('PUT')
            <select name="status" style="padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="btn btn-success">Update Status</button>
        </form>
    </div>
    
    <div style="margin-top: 20px;">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Back to Orders</a>
    </div>
</div>
@endsection

