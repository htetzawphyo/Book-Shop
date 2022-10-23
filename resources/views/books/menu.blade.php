@extends('layouts.master')

    @section('content')
                
                <div class="card">
                    <div class="card-header">
                      <h3 class="d-inline text-navy font-weight-bold">Books</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="table_id" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No.</th>
                          <th>Author Name</th>
                          <th>Type of book</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $i = 1;
                          ?>
                          @foreach ($books as $book)
                            <tr>
                              <td>{{ $i }}</td>
                              <td>{{ $book->author->name }}</td>
                              <td>{{ $book->quantity }}</td>
                              <td>
                                <div class="d-flex">
                                  <a href="" 
                                    class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-user-pen"></i>  
                                    <span class="d-none d-md-inline-block">View more</span>
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <?php
                            $i++;
                            ?>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
              
            </div>
          </div>
        </div>
      </div>    
    
<!-- Page data table script -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<script>

    // Data Table
      $(document).ready( function () {
          $('#table_id').DataTable({
            ordering: false,
            info: false,
            lengthMenu: [5],
            lengthChange: false,
          });
      } );
</script>

@endsection