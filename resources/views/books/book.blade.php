@extends('layouts.master')

    @section('content')
                <div class="card">
                    <div class="card-header">
                      <h3 class="d-inline text-navy font-weight-bold">Books</h3>
                      <a href="/books/create" class="btn btn-default float-end bg-secondary text-white">
                        <i class="fa-solid fa-book-bible"></i> &nbsp;
                        <span class="d-none d-md-inline-block">Add Book</span>
                      </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                      @endif
                      
                      <table class="table books-table w-100 table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Author Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                </div> 


@endsection

@section('script')
<script>
  // Data Table
    $(document).ready( function () {
      var table = $('.books-table').DataTable({
          ordering: false,
          info: false,
          scrollX: true,
          lengthMenu: [6],
          lengthChange: false,
          processing: true,
          serverSide: true,
          ajax: '{!! route('books.datas') !!}',
          columns: [
              { data: 'DT_RowIndex', name: 'DT_RowIndex', 'searchable': false,},
              { data: 'name', name: 'name' },
              { data: 'price', name: 'price' },
              { data: 'quantity', name: 'quantity' },
              { data: 'author_name', name: 'author_name' },
              { data: 'actions', name: 'actions', }
            ]
      });
    } );

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