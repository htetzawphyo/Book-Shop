@extends('layouts.master')

    @section('content')
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline text-navy font-weight-bold">User</h3>
                <a href="/users" class="btn btn-default float-end bg-secondary text-white">
                <span class="d-none d-md-inline-block"><< Back</span>
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <p class="h4 text-center">User Information</p>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="fw-bold h5 mb-3">Name - </span>
                                    <span>{{ $user->name }}</span>  
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold h5">Email - </span>
                                    <span>{{ $user->email }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold h5">Phone - </span>
                                    <span>{{ $user->phone }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold h5">Address - </span>
                                    <span>{{ $user->address }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold h5">Role - </span>
                                    <span class="badge {{ $user->role->name === 'Admin' ? 'bg-danger' : 'bg-success' }}">{{ $user->role->name }}</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <form action="/users/{{ $user->id }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                          Change Role
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                                          <li>
                                            <button class="dropdown-item py-0">
                                               {{ $user->role->name === "Admin" ? "User" : "Admin" }}
                                            </button>
                                          </li>
                                        </ul>
                                    </div>
                                </form>

                                <form action="/users/{{ $user->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Are you sure you want to delete?')">
                                        <i class="fa-solid fa-trash-can"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
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