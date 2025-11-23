<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show checkout page.
     */
    public function index()
    {
        $cartItems = CartItem::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->subtotal;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    /**
     * Process the order.
     */
    public function store(Request $request)
    {
        $cartItems = CartItem::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'shipping_address' => 'required|string|max:500',
            'billing_address' => 'nullable|string|max:500',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            // Calculate total
            $total = $cartItems->sum(function ($item) {
                return $item->subtotal;
            });

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $validated['shipping_address'],
                'billing_address' => $validated['billing_address'] ?? $validated['shipping_address'],
                'phone' => $validated['phone'],
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create order items and update stock
            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;

                if ($product->stock_quantity < $cartItem->quantity) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $cartItem->quantity,
                    'price' => $product->price,
                    'subtotal' => $cartItem->subtotal,
                ]);

                // Update stock
                $product->decrement('stock_quantity', $cartItem->quantity);
            }

            // Clear cart
            CartItem::where('user_id', auth()->id())->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Order failed: ' . $e->getMessage());
        }
    }
}
