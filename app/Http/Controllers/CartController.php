<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->get();
        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);

        $cart = new Cart();
        $cart->product_id = $product->id;
        $cart->quantity = $request->input('quantity');
        $cart->save();

        return redirect('/cart');
    }
    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}
