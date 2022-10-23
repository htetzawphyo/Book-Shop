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
					<h3 class="card-title h2">102,250</h3>
					<span class="text-success">
						<i class="fas fa-chart-line"></i>
						Yearly visitors
					</span>
				</div>
			</div>
		</div>
	</div>

	<!-- Location & Data Blocks -->
	<div class="row mt-4 flex-column flex-lg-row">						
		<div class="col">
			<h2 class="h6 text-dark-50">LOCATION</h2>

			<div class="card mb-3" style="height: 280px">
				<div class="card-body">
					<small class="text-muted">Regional</small>
					<div class="progress mb-4 mt-2" style="height: 5px">
						<div class="progress-bar bg-success w-25"></div>
					</div>
					<small class="text-muted">Global</small>
					<div class="progress mb-4 mt-2" style="height: 5px">
						<div class="progress-bar bg-primary w-75"></div>
					</div>
					<small class="text-muted">Local</small>
					<div class="progress mb-4 mt-2" style="height: 5px">
						<div class="progress-bar bg-warning w-50"></div>
					</div>
					<small class="text-muted">Internal</small>
					<div class="progress mb-4 mt-2" style="height: 5px">
						<div class="progress-bar bg-danger w-25"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="col">
		<h2 class="h6 text-dark-50">DATA</h2>

		<div class="card mb-3" style="height: 280px">
			<div class="card-body">
				<div class="text-right">
					<button class="btn btn-sm btn-outline-secondary">
						<i class="fas fa-search"></i>
					</button>
					<button class="btn btn-sm btn-outline-secondary">
						<i class="fas fa-sort-amount-up"></i>
					</button>
					<button class="btn btn-sm btn-outline-secondary">
						<i class="fas fa-filter"></i>
					</button>
				</div>

				<table class="table">
					<tr>
						<th>ID</th>
						<th>Age Group</th>
						<th>Data</th>
						<th>Progress</th>
					</tr>
					<tr>
						<td>1</td>
						<td>20-30</td>
						<td>19%</td>
						<td>
							<i class="fas fa-chart-pie"></i>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>30-40</td>
						<td>40%</td>
						<td>
							<i class="fas fa-chart-bar"></i>
						</td>
					</tr>
					<tr>
						<td>3</td>
						<td>40-50</td>
						<td>20%</td>
						<td>
							<i class="fas fa-chart-line"></i>
						</td>
					</tr>
					<tr>
						<td>4</td>
						<td>50</td>
						<td>11%</td>
						<td>
							<i class="fas fa-chart-pie"></i>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
					

@endsection