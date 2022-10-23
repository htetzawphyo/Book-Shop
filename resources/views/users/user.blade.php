@extends('layouts.master')

    @section('content')
                <div class="card">
                    <div class="card-header">
                      <h3 class="d-inline text-navy font-weight-bold">Users</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                      @endif
                      
                      <table class="table users-table w-100 table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {{ $users->withQueryString()->links() }}

                          {{-- Search Form --}}
                          <div class="row my-2">
                            <div class="col-md-4">
                              <form action="{{ route('users.index') }}" method="GET">
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
                          @foreach ($users as $key => $user)
                              <tr>
                                <td>{{ $key + $users->firstItem() }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                  <span class="badge {{ $user->role->name === 'Admin' ? 'bg-danger' : 'bg-success' }}">{{ $user->role->name }}</span>
                                </td>
                                <td>
                                  <a href="/users/{{ $user->id }}" class="btn btn-warning btn-sm">View More >></a>
                                </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div> 


@endsection

@section('script')
<script>
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