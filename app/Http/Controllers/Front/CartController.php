<?php

namespace App\Http\Controllers\Front;
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category; // Correctly import Category model
use App\Models\Product;

class CartController extends Controller
{
    public function show()
    {
        // Retrieve the cart items from the session
        $cart = session()->get('cart', []);
        $cartItems = collect($cart);
        $categories = Category::withCount('products')->get();
    
        // Calculate total price
        $totalPrice = $cartItems->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    
        return view('front.cart', compact('cartItems', 'totalPrice', 'categories'));
    }

    public function update(Request $request)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|integer',
            'action' => 'required|in:increment,decrement',
        ]);

        $productId = $request->input('product_id');
        $action = $request->input('action');
        
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($action === 'increment') {
                $cart[$productId]['quantity']++;
            } elseif ($action === 'decrement' && $cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show');
    }

    public function remove(Request $request)
    {
        // Validate product_id
        $request->validate([
            'product_id' => 'required|integer',
        ]);
    
        $productId = $request->input('product_id');
    
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);
    
        // Check if the product exists in the cart and remove it
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart); // Update the session with the modified cart
        }
    
        return redirect()->route('cart.show')->with('success', 'Product removed from cart!');
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Fetch the product
        $product = Product::findOrFail($request->product_id);
        $quantity = (int) $request->quantity; // Ensure quantity is an integer
    
        $cart = session()->get('cart', []);
    
        if (isset($cart[$request->product_id])) {
            // If the product is already in the cart, update the quantity
            $cart[$request->product_id]['quantity'] += $quantity;
        } else {
            // Otherwise, add the product to the cart
            $cart[$request->product_id] = [
                'product_id' => $product->id,
                'name' => $product->product_name,
                'quantity' => $quantity,
                'price' => $product->product_price,
                'main_image' => $product->main_image,
                'category_name' => $product->category->category_name ?? 'No Category', // Ensure category_name is added here
            ];
        }
    
        session()->put('cart', $cart);
    
        return redirect()->back()->with('success', 'Product added to cart!');
    }
}









