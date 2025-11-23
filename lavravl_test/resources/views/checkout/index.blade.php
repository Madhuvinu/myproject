<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .header { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .checkout-container { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .checkout-form, .order-summary { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .form-group textarea { min-height: 100px; }
        .btn { padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-success { background: #28a745; color: white; width: 100%; }
        .btn-primary { background: #007bff; color: white; }
        .btn:hover { opacity: 0.9; }
        .order-item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; }
        .order-summary h3 { margin-bottom: 20px; }
        .summary-total { font-size: 1.5rem; font-weight: bold; border-top: 2px solid #ddd; padding-top: 10px; margin-top: 10px; }
        .alert { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        @media (max-width: 768px) {
            .checkout-container { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Checkout</h1>
            <a href="{{ route('cart.index') }}" style="color: #007bff; text-decoration: none;">← Back to Cart</a>
        </div>

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="checkout-container">
                <div class="checkout-form">
                    <h2>Shipping Information</h2>
                    
                    <div class="form-group">
                        <label for="shipping_address">Shipping Address *</label>
                        <textarea id="shipping_address" name="shipping_address" required>{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="billing_address">Billing Address</label>
                        <textarea id="billing_address" name="billing_address">{{ old('billing_address') }}</textarea>
                        @error('billing_address')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="notes">Order Notes (Optional)</label>
                        <textarea id="notes" name="notes">{{ old('notes') }}</textarea>
                        @error('notes')<div style="color: red; margin-top: 5px;">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="order-summary">
                    <h3>Order Summary</h3>
                    
                    @foreach($cartItems as $item)
                        <div class="order-item">
                            <div>
                                <strong>{{ $item->product->name }}</strong><br>
                                <small>Qty: {{ $item->quantity }} × ${{ number_format($item->product->price, 2) }}</small>
                            </div>
                            <div>${{ number_format($item->subtotal, 2) }}</div>
                        </div>
                    @endforeach

                    <div class="order-item summary-total">
                        <span>Total:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>

                    <button type="submit" class="btn btn-success" style="margin-top: 20px;">Place Order</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

