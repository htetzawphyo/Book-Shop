<?php

namespace App\Http\Controllers\Menu;

use App\Models\Book;
use App\Models\Order;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        $items = Order::groupBy('book_id')
                        ->selectRaw('sum(quantity) as qty, book_id')
                        ->orderBy('qty', 'desc')
                        ->limit(5)
                        ->get();
                        
        $authors = Author::all();
        if(isset($_GET['query'])){
            $search_text = $_GET['query'];
            $books = Book::where([
                ['name', 'LIKE', '%'. $search_text .'%'],
                ['quantity', '>', 0]
            ])
                            ->paginate(12);
            // $books->appends(['query' => $search_text]);
            return view('index', compact('books', 'authors', 'items'));
        }else {
            $books = Book::where('quantity', '>', 0)->paginate(12);
            return view('index', compact('books', 'authors', 'items'));
        }
    }

    public function about()
    {
        $authors = Author::all();
        return view('home.about', compact('authors'));
    }

    public function author(Author $author)
    {
        $data = [];
        foreach($author->books as $qty){
            if($qty->quantity != 0){
                $data[] = $qty;
            }
        }
        $authors = Author::all();
        return view('home.author', compact('data', 'authors'));
    }

    public function bookDetail(Book $book)
    {
        $books = Book::where([
            ['author_id', $book->author_id],
            ['quantity', '>', 0]
        ])
                        ->get()
                        ->except($book->id);
        $authors = Author::all();
        return view('home.book', compact('authors', 'book', 'books'));
    }

    public function cartDetail()
    {
        $authors = Author::all();
        return view('home.cartDetail', compact('authors'));
    }
}
