<?php

namespace App\Http\Controllers\Cart;

use App\Models\Book;
use App\Models\Author;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartList()
    {
        $authors = Author::all();
        $cartItems = \Cart::getContent();

        if(\Cart::isEmpty()){
            return back();
        } else {
            return view('home.cartDetail', compact('cartItems', 'authors'));
        }
    }

    public function addToCart(Request $request)
    {
        $books = Book::find($request->bookId);
        if($request->quantity > $books->quantity){
            return back()->with('msg', 'လူကြီးမင်း မှာယူမည့် စာအုပ်အရေအတွက်သည် ကျွန်ုပ်တို့စီ၌ ရှိထားသော စာအုပ်အရေအတွက်ထက် များနေပါသည်။');
        } else {
            \Cart::add([
                'id' => $request->bookId,
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

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);

        if(\Cart::isEmpty()){
            return redirect('/');
        } else {
            return redirect()->route('cart.list');
        }
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        if(\Cart::isEmpty()){
            return redirect('/');
        } else {
            return redirect()->route('cart.list');
        }
    }
}
