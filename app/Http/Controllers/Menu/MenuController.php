<?php

namespace App\Http\Controllers\Menu;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        if(isset($_GET['query'])){
            $search_text = $_GET['query'];
            $books = Book::where('name', 'LIKE', '%'. $search_text .'%')->paginate(12);
            // $books->appends(['query' => $search_text]);
            return view('index', compact('books', 'authors'));
        }else {
            $books = Book::paginate(12);
            return view('index', compact('books', 'authors'));
        }
    }

    public function about()
    {
        $authors = Author::all();
        return view('home.about', compact('authors'));
    }

    public function author(Author $author)
    {
        $data = $author->books;
        $authors = Author::all();
        return view('home.author', compact('data', 'authors'));
    }

    public function bookDetail(Book $book)
    {
        $books = Book::where('author_id', $book->author_id)->get()->except($book->id);
        $authors = Author::all();
        return view('home.book', compact('authors', 'book', 'books'));
    }

    public function cartDetail()
    {
        $authors = Author::all();
        return view('home.cartDetail', compact('authors'));
    }
}
