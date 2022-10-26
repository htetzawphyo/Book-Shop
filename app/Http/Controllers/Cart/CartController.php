<?php

namespace App\Http\Controllers\Cart;

use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartList()
    {
        // $cartItems = \Cart::getContent();
        $userId = Auth::user()->id; // or any string represents user identifier
        $cartItems = \Cart::session($userId)->getContent();
        dd($cartItems);
        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        // \Cart::add([
        //     'id' => $request->id,
        //     'name' => $request->name,
        //     'price' => $request->price,
        //     'quantity' => $request->quantity,
        //     'attributes' => array(
        //         'image' => $request->image,
        //     )
        // ]);
        // session()->flash('success', 'Product is Added to Cart Successfully !');

        // return back();

        $userId = Auth::user()->id; // or any string represents user identifier
        \Cart::session($userId)->add([
            'id' => $request->id, // inique row ID
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => $request->image,
            ]
        ]);
        return back();
    }
}
