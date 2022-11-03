<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>

	{{-- Datatable --}}
	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	 
	<!-- Bootstrap Link -->
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

	{{-- Custom CSS --}}
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<!-- Fonat Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	{{-- Sweet Alert --}} 
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<style>
		body {
			background-color: #e2f3f5;
		}
	</style>
	

</head>
<body>

	<div class="container-fluid">
		<div class="row g-2">

			<nav class="py-3">

					<h1 class="h4 py-3 text-primary d-inline">
						<i class="fas fa-ghost mr-2"></i>
						<span class="d-none d-lg-inline">BOOK SHOP</span>
					</h1>

					<div class="d-inline d-flex float-end mr-3">
						<button class="btn btn-primary btn-sm">
							<i class="fa-solid fa-circle-user mr-3"></i>
							{{ Auth::user()->name }}
						</button>
						<span>&nbsp;</span>
						
						<form action="{{ route('logout') }}" method="POST">
							@csrf
							<button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to logout?')">
								<i class="fa-solid fa-right-from-bracket"></i>
								Logout
							</button>
						</form>
					</div>
				
			</nav>
			<!-- Sidebar Navigation -->
			<nav class="col-2 pr-3 mainBody">
				<div class="list-group text-center text-lg-left">
					<span class="list-group-item disabled d-none d-lg-block">
						<small>CONTROLS</small>
					</span>
					<a href="../admin" class="list-group-item list-group-item-action">
						<i class="fas fa-home"></i>
						<span class="d-none d-lg-inline">Dashboard</span>
					</a>
					<a href="/authors" class="list-group-item list-group-item-action action">
						<i class="fa-solid fa-users"></i>
						<span class="d-none d-lg-inline">Authors</span>
						<span class="d-none d-lg-inline badge bg-danger rounded-pill float-right">
							{{ DB::table('authors')->count() }}
						</span>
					</a>
					<a href="/books" class="list-group-item list-group-item-action action">
						<i class="fa-sharp fa-solid fa-book"></i>
						<span class="d-none d-lg-inline">Books</span>
					</a>
					<a href="/users" class="list-group-item list-group-item-action action">
						<i class="fa-solid fa-users"></i>
						<span class="d-none d-lg-inline">Users</span>
					</a>
				</div>
			</nav>
			<!-- End Sidebar navigation -->

			<main class="col-10 mainBody">

				<!-- Alert & Stat Blocks -->
				<div class="container-fluid">
					@yield('content')					
				</div>
				<!-- End Alert & Stat Blocks -->

			</main>

		</div>
	</div>
	
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

	{{-- jQuery --}}
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

	{{-- Datatable --}}
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

	@yield('script')
</body>
</html>