<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    
    public function index()
    {

        $datas = Order::groupBy('book_id')
                        ->selectRaw('sum(quantity) as qty, book_id')
                        ->orderBy('qty', 'desc')
                        ->limit(5)
                        ->get();

        $goldUsers = Order::groupBy('user_id')
                            ->selectRaw('sum(price) as price, user_id')
                            ->orderBy('price', 'desc')
                            ->get()
                            ->where('price', '>', 3500);

        return view('dashboard', compact('datas', 'goldUsers'));
    }
}
