@extends('layouts.master')

    @section('content')
                
                <div class="card">
                    <div class="card-header">
                      <h3 class="d-inline text-navy font-weight-bold">Authors</h3>
                      <a href="/authors/create" class="btn btn-default float-end bg-secondary text-white">
                        <i class="fa-solid fa-user-plus"></i> &nbsp;
                        <span class="d-none d-md-inline-block">Add Author</span>
                      </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                      @endif

                      <table class="table table-bordered  w-100 authors-table" id="">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {{ $authors->links() }}

                          {{-- Search  Form--}}
                          <div class="row my-2">
                            <div class="col-md-4">
                              <form action="{{ route('authors.index') }}" method="GET">
                                <div class="input-group">
                                  <input type="search" id="form1" class="form-control" name="query" placeholder="Search here......">
                                  <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div>
                              </form>
                            </div>
                            <div class="col-md-8"></div>
                          </div>
                          @foreach ($authors as $key => $author)
                              <tr>
                                <td>{{ $key + $authors->firstItem() }}</td>
                                <td>{{ $author->name }}</td>
                                <td>
                                  <div class="d-flex">
                                    
                                    <a href="/authors/{{ $author->id }}/edit" class="btn btn-warning btn-sm h-25">
                                      <i class="fa-sharp fa-solid fa-pen-to-square"></i>
                                      Edit
                                    </a>
                                    <form action="/authors/{{$author->id}}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button class="mx-2 btn btn-danger btn-sm ml-2" type="submit"
                                      onclick="return confirm('Are you sure you want to delete')"
                                      >
                                      <i class="fa-solid fa-trash-can"></i>
                                      Delete</button>
                                    </form>
                                  </div>
                                  </td>
                                </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
              
            </div>
          </div>
        </div>
      </div>    
 
@endsection
@section('script')

<script>

    // Success Message
      @if (session('success'))
      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
      });

      Toast.fire({
          icon: 'success',
          title: '{{ session('success') }}'
      });
      @endif

      
      // Delete Message
      @if (session('delete'))
      const Toast = Swal.mixin({
          toast: true,
          position: 'top',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
      });

      Toast.fire({
          icon: 'error',
          title: '{{ session('delete') }}'
      });
      @endif

      
  </script>

@endsection