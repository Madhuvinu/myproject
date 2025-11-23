<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmation - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .order-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .success-message { background: #d4edda; color: #155724; padding: 20px; border-radius: 8px; margin-bottom: 30px; text-align: center; }
        .success-message h2 { margin-bottom: 10px; }
        .order-info { margin-bottom: 30px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; }
        .info-row:last-child { border-bottom: none; }
        .order-items { margin-top: 30px; }
        .order-item { display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #eee; }
        .order-item:last-child { border-bottom: none; }
        .item-details { flex: 1; }
        .item-name { font-weight: 600; margin-bottom: 5px; }
        .item-quantity { color: #666; font-size: 0.9rem; }
        .total-row { font-size: 1.3rem; font-weight: bold; border-top: 2px solid #ddd; padding-top: 15px; margin-top: 15px; }
        .status-badge { padding: 5px 15px; border-radius: 20px; font-size: 0.9rem; font-weight: 600; }
        .status-pending { background: #fff3cd; color: #856404; }
        .btn { padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .actions { margin-top: 30px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="order-container">
            @if(session('success'))
                <div class="success-message">
                    <h2>✅ Order Placed Successfully!</h2>
                    <p>Thank you for your order. We'll process it soon.</p>
                </div>
            @endif

            <div class="order-info">
                <h2>Order #{{ $order->order_number }}</h2>
                <div class="info-row">
                    <span>Order Date:</span>
                    <span>{{ $order->created_at->format('F d, Y h:i A') }}</span>
                </div>
                <div class="info-row">
                    <span>Status:</span>
                    <span class="status-badge status-pending">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="info-row">
                    <span>Shipping Address:</span>
                    <span>{{ $order->shipping_address }}</span>
                </div>
                @if($order->phone)
                <div class="info-row">
                    <span>Phone:</span>
                    <span>{{ $order->phone }}</span>
                </div>
                @endif
            </div>

            <div class="order-items">
                <h3>Order Items</h3>
                @foreach($order->orderItems as $item)
                    <div class="order-item">
                        <div class="item-details">
                            <div class="item-name">{{ $item->product->name }}</div>
                            <div class="item-quantity">Quantity: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</div>
                        </div>
                        <div>${{ number_format($item->subtotal, 2) }}</div>
                    </div>
                @endforeach

                <div class="order-item total-row">
                    <span>Total Amount:</span>
                    <span>${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>

            <div class="actions">
                <a href="/" class="btn btn-primary">Continue Shopping</a>
            </div>
        </div>
    </div>
</body>
</html>

