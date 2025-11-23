<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the cart.
     */
    public function index()
    {
        $cartItems = CartItem::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->subtotal;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock_quantity,
        ]);

        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $validated['quantity'];
            if ($newQuantity > $product->stock_quantity) {
                return redirect()->back()->with('error', 'Not enough stock available.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!')->with('scroll', 'products');
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cartItem->product->stock_quantity,
        ]);

        $cartItem->update($validated);

        return redirect()->back()->with('success', 'Cart updated.');
    }

    /**
     * Remove item from cart.
     */
    public function remove(CartItem $cartItem)
    {
        if ($cartItem->user_id !== auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}
