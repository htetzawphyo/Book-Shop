<?php

namespace App\Http\Controllers\Author;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\AuthorCreateRequest;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['query'])){
            $search_text = $_GET['query'];
            $authors = Author::where('name', 'LIKE', '%'. $search_text .'%')->paginate(1);
            $authors->appends(['query' => $search_text]);
            return view('authors.author', compact('authors'));
        } else {
            $authors = Author::latest()->paginate(5);
            return view('authors.author', compact('authors'));
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorCreateRequest $request)
    {
        $author = new Author();
        $author->name = $request->name;

        $author->save();

        return redirect('/authors')->with('success', 'Author successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('/authors/edit', [ 'author' => $author ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorCreateRequest $request, Author $author)
    {
        $author->name = $request->name;
        $author->save();

        return redirect('/authors')->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return back()->with('delete', 'Deleted Successfully.');
    }
}
