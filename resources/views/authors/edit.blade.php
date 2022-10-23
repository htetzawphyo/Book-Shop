@extends('layouts.master')

@section('content')

    <div class="py-2">
        <h3 class="d-inline text-navy font-weight-bold">Edit Author</h3>
        <a href="/authors" class="btn btn-success btn-sm float-end bg-gray">
            <i class="fa-sharp fa-solid fa-backward"></i>
            <span class="font-weight-bold h5">Back</span>
        </a>
        @error('name')
            <div class="alert alert-danger my-2">{{ $message }}</div>
        @enderror
        <div class="card mt-3">
            
            <form action="/authors/{{ $author->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        placeholder="Name"
                        value="{{ $author->name }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success bg-gray">
                        <i class="fa-solid fa-floppy-disk"></i>    
                        <span class="font-weight-bold">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


