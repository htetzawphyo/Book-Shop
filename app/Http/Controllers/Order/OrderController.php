<?php

namespace App\Http\Controllers\Order;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(){

        $cartItems = \Cart::getContent();
        $userId = Auth::user()->id;
        
        foreach($cartItems as $key => $value){
            $bookId = $key;

            $order = new Order();
            $order->price = $value->price * $value->quantity;
            $order->quantity = $value->quantity;
            $order->user_id = $userId;
            $order->book_id = $bookId;
            $order->save();

            $book = Book::find($bookId);            
            $book->quantity = $book->quantity - $value->quantity;
            $book->save();
        };
        \Cart::clear();
        return redirect('/')->with('success', 'Order Submitted. Thank you.');
    }
}
