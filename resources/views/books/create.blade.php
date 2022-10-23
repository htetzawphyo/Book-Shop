@extends('layouts.master')

@section('content')

                <div>
                    <h3 class="d-inline text-navy font-weight-bold">Add Book</h3>
                    <a href="/books" class="btn btn-success btn-sm float-end bg-gray">
                        <i class="fa-sharp fa-solid fa-backward"></i>
                        <span class="font-weight-bold h5">Back</span>
                    </a>
                    
                    <div class="card mt-3">
                        
                        <form action="/books" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Name"
                                    value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Price</label>
                                    <input type="number" name="price" 
                                    class="form-control @error('price') is-invalid @enderror" 
                                    placeholder="Price" 
                                    value="{{ old('price') }}">
                                    @error('price')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Number Of Book</label>
                                    <input type="number" name="quantity" 
                                    class="form-control @error('quantity') is-invalid @enderror" 
                                    placeholder="Number of Book"
                                    value="{{ old('quantity') }}">
                                    @error('quantity')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Select Author</label>
                                    <select class="form-select" name="author_id">
                                        <option>Open this select menu</option>
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control @error('quantity') is-invalid @enderror" type="file" id="formFile" name="image">
                                    @error('image')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success bg-gray">
                                    <i class="fa-solid fa-floppy-disk"></i>    
                                    <span class="font-weight-bold">Save</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
@endsection