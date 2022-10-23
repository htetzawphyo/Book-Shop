@extends('layouts.master')

@section('content')

                <div>
                    <h3 class="d-inline text-navy font-weight-bold">Add Author</h3>
                    <a href="/authors" class="btn btn-success btn-sm float-end bg-gray">
                        <i class="fa-sharp fa-solid fa-backward"></i>
                        <span class="font-weight-bold h5">Back</span>
                    </a>
                    @error('name')
                        <div class="alert alert-danger my-2">{{ $message }}</div>
                    @enderror
                    <div class="card mt-3">
                        
                        <form action="/authors" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Name">
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