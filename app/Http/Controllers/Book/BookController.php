<?php

namespace App\Http\Controllers\Book;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookEditRequest;
use App\Http\Requests\BookCreateRequest;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    public function index()
    {
        // $books = Book::orderBy('id', 'desc')->get();
        return view('books.book');
    }
    public function getData()
    {
        $books = Book::with('author');
        return DataTables::of($books)
            ->addIndexColumn()
            ->addColumn('author_name', function($book){
                return $book->author ? $book->author->name : '-';
            })
            ->addColumn('actions', function($book) {                
                return '<div class="d-flex">'.
                    '<a href="/books/'.$book->id.'/edit" class="btn btn-warning btn-sm"><i class="fa-sharp fa-solid fa-pen-to-square"></i> Edit</a>'.
                    '<form action="/books/'.$book->id.'" method="POST">'.
                        csrf_field().
                        method_field('DELETE').
                        '<button class="mx-1 btn btn-danger btn-sm show_confirm" type="submit" onclick="return confirm(\'Are you sure you want to Delete\')">'.
                            '<i class="fa-solid fa-trash-can"></i>'.
                            '<span class="d-none d-md-inline-block">&nbsp;Delete</span>'.
                        '</button>'. 
                    '</form>'.
                '</div>'; 
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function create()
    {
        $authors = Author::all();
        return view('books/create', compact('authors'));
    }

    public function store(BookCreateRequest $request)
    {
        $imgName = time() . '_' . $request->file('image')->getClientOriginalName();
        
        $book = new Book();
        $book->name = $request->name;
        $book->price = $request->price;
        $book->quantity = $request->quantity;
        $book->author_id = $request->author_id;

        $request->file('image')->move(public_path('images'), $imgName);

        $book->image = $imgName;
        $book->save();

        return redirect('/books')->with('success', 'Book successfully added.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books/edit', [ 'book' => $book, 'authors' => $authors ]);
    }

    public function update(BookEditRequest $request, Book $book)
    {
        $book->name = $request->name;
        $book->price = $request->price;
        $book->quantity = $request->quantity;
        $book->author_id = $request->author_id;

        if($request->file('image')){
            $imgName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imgName);
            $book->image = $imgName;
        }

        $book->save();

        return redirect('/books')->with('success', 'Book edited successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books')->with('delete', 'Deleted Successfully.');
    }
}
