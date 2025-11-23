<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header h1 { margin: 0; }
        .cart-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .cart-item { display: flex; gap: 20px; padding: 20px; border-bottom: 1px solid #eee; }
        .cart-item:last-child { border-bottom: none; }
        .item-image { width: 120px; height: 120px; object-fit: cover; border-radius: 8px; }
        .item-details { flex: 1; }
        .item-name { font-size: 1.2rem; font-weight: 600; margin-bottom: 5px; }
        .item-price { color: #666; margin-bottom: 10px; }
        .quantity-controls { display: flex; align-items: center; gap: 10px; margin: 10px 0; }
        .quantity-controls input { width: 60px; padding: 5px; text-align: center; border: 1px solid #ddd; border-radius: 4px; }
        .btn { padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn:hover { opacity: 0.9; }
        .cart-summary { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 20px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .summary-total { font-size: 1.5rem; font-weight: bold; border-top: 2px solid #ddd; padding-top: 10px; margin-top: 10px; }
        .empty-cart { text-align: center; padding: 60px 20px; }
        .empty-cart h2 { margin-bottom: 20px; color: #666; }
        .alert { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .actions { display: flex; gap: 10px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Shopping Cart</h1>
            <a href="/" style="color: #007bff; text-decoration: none;">← Continue Shopping</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($cartItems->count() > 0)
            <div class="cart-container">
                @foreach($cartItems as $item)
                    <div class="cart-item">
                        <img src="{{ $item->product->image ? asset('storage/products/' . $item->product->image) : asset('images/placeholder.png') }}" 
                             alt="{{ $item->product->name }}" class="item-image" 
                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'120\' height=\'120\'%3E%3Crect fill=\'%23ddd\' width=\'120\' height=\'120\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'%23999\'%3ENo Image%3C/text%3E%3C/svg%3E'">
                        <div class="item-details">
                            <div class="item-name">{{ $item->product->name }}</div>
                            <div class="item-price">${{ number_format($item->product->price, 2) }} each</div>
                            <div class="quantity-controls">
                                <form action="{{ route('cart.update', $item) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <label>Quantity:</label>
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_quantity }}" required>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                            <div style="margin-top: 10px;">
                                <strong>Subtotal: ${{ number_format($item->subtotal, 2) }}</strong>
                            </div>
                            <div class="actions">
                                <form action="{{ route('cart.remove', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Remove this item from cart?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span>Calculated at checkout</span>
                    </div>
                    <div class="summary-row summary-total">
                        <span>Total:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div style="margin-top: 20px;">
                        <a href="{{ route('checkout.index') }}" class="btn btn-success" style="width: 100%; text-align: center; padding: 15px; font-size: 1.1rem;">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        @else
            <div class="cart-container">
                <div class="empty-cart">
                    <h2>Your cart is empty</h2>
                    <p style="color: #666; margin-bottom: 30px;">Add some products to your cart to get started!</p>
                    <a href="/" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        @endif
    </div>
</body>
</html>

