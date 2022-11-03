@extends('layouts.master')

@section('content')

	<div class="row flex-column flex-lg-row">
		<h2 class="h6 text-dark-50">QUICK STATS</h2>
		<div class="col">
			<div class="card mb-3">
				<div class="card-body">
					<h3 class="card-title h2">{{ DB::table('books')->sum('quantity') }}</h3>
					<span class="text-success">
						<i class="fa-solid fa-book"></i>
						Number Of Book
					</span>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card mb-3">
				<div class="card-body">
					<h3 class="card-title h2">{{ DB::table('authors')->count() }}</h3>
					<span class="text-success">
						<i class="fa-solid fa-users"></i>
						Authors
					</span>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card mb-3">
				<div class="card-body">
					<h3 class="card-title h2">{{ DB::table('users')->count() }}</h3>
					<span class="text-success">
						<i class="fa-solid fa-users"></i>
						Total Users
					</span>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card mb-3">
				<div class="card-body">
					<h3 class="card-title h2">{{ DB::table('orders')->sum('quantity') }}</h3>
					<span class="text-success">
						<i class="fas fa-chart-line"></i>
						Total Order Quantity
					</span>
				</div>
			</div>
		</div>
	</div>

	<!-- Location & Data Blocks -->
	<div class="row mt-4 flex-column flex-lg-row">						
		<div class="col">
			<h2 class="h6 text-dark-50">Best Seller Books</h2>

			<div class="card mb-3">
				<div class="card-body">
					<table class="table ">
						<thead>
							<tr>
								<th>No</th>
								<th>Book Name</th>
								<th>Author Name</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i = 1;
							?>
							@foreach ($datas as $value)
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $value->book->name }}</td>
									<td>{{ $value->book->author->name }}</td>
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

		<div class="col">
		<h2 class="h6 text-dark-50">Gold Members</h2>

		<div class="card mb-3">
			{{-- table-wrapper-scroll-y my-custom-scrollbar --}}
			<div class="card-body col-xs-8 col-xs-offset-2 well">
				<table class="table table-scroll">
					<thead class="">
						<tr>
							<th>No</th>
							<th>User Name</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody class="custom-body">
						<?php 
							$i = 1;
						?>
						@foreach ($goldUsers as $value)
							<tr>
								<td>{{ $i }}</td>
								<td>{{ $value->user->name }}</td>
								<td>{{ $value->price }}</td>
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
					

@endsection