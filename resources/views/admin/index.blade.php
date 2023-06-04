	@extends('admin.admin_dashboard')

    @section('admin')


	@php
		$today_date = date('d-m-y');
		$today_total_sales = App\Models\Order::where('order_date', $today_date)->sum('amount');

		$month_date = date('F');
		$month_total_sales = App\Models\Order::where('order_month', $month_date)->sum('amount');

		$year_date = date('Y');
		$year_total_sales = App\Models\Order::where('order_year', $year_date)->sum('amount');

		$total_sales = App\Models\Order::sum('amount');

		
		
		//////////////////////////

		$pending_orders = count(App\Models\Order::where('status', 'pending')->latest()->get());
		$confirmed_orders = count(App\Models\Order::where('status', 'confirmed')->latest()->get());
		$processing_orders = count(App\Models\Order::where('status', 'processing')->latest()->get());
		$delivered_orders = count(App\Models\Order::where('status', 'delivered')->latest()->get());


		$pending_boutique_requests = count(App\Models\User::where('role', 'vendor')->where('status', 'inactive')->latest()->get());
		$active_boutiques = count(App\Models\User::where('role', 'vendor')->where('status', 'active')->latest()->get());
		$rejected_boutique_requests = count(App\Models\User::where('role', 'vendor')->where('status', 'rejected')->latest()->get());

		$customers=count(App\Models\User::where('role', 'user')->latest()->get());
	@endphp
        
    
    <!--start page wrapper -->
	<div class="page-content">

		<div class="pb-3 pt-3" >
		<h4>Sales Reporting Cards</h4>
		</div>
		<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">


			<div class="col">
				<div class="card radius-10 bg-gradient-deepblue">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$today_total_sales}} BHD</h5>
						<div class="ms-auto">
							<i class='bx bx-dollar fs-3 text-white'></i>
						</div>
					</div>
					
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Today`s Sales</p>
					</div>
				</div>
			  </div>
			</div>



			<div class="col">
				<div class="card radius-10 bg-gradient-deepblue">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$month_total_sales}} BHD</h5>
						<div class="ms-auto">
							<i class='bx bx-dollar fs-3 text-white'></i>
						</div>
					</div>
					
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Month Sales</p>
					</div>
				</div>
			  </div>
			</div>



			<div class="col">
				<div class="card radius-10 bg-gradient-deepblue">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$year_total_sales}} BHD</h5>
						<div class="ms-auto">
							<i class='bx bx-dollar fs-3 text-white'></i>
						</div>
					</div>
					
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Year Sales</p>
					</div>
				</div>
			</div>
			</div>



			<div class="col">
				<div class="card radius-10 bg-gradient-deepblue">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$total_sales}} BHD</h5>
						<div class="ms-auto">
							<i class='bx bx-dollar fs-3 text-white'></i>
						</div>
					</div>
					
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Total Sales</p>
					</div>
				</div>
			</div>
			</div>


		</div><!--end row-->


		<div class="pb-3 pt-3" >
			<h4>Orders Reporting Cards</h4>
		</div>

		<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">


			<div class="col">
				<div class="card radius-10 bg-gradient-ibiza">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$pending_orders}} Order</h5>
						<div class="ms-auto">
							<i class='bx bx-cart fs-3 text-white'></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Pending Orders</p>
					</div>
				</div>
			  </div>
			</div>



			<div class="col">
				<div class="card radius-10 bg-gradient-ibiza">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$confirmed_orders}} Order</h5>
						<div class="ms-auto">
							<i class='bx bx-cart fs-3 text-white'></i>
						</div>
					</div>
					
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Confirmed Orders</p>
					</div>
				</div>
			  </div>
			</div>



			<div class="col">
				<div class="card radius-10 bg-gradient-ibiza">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$processing_orders}} Order</h5>
						<div class="ms-auto">
							<i class='bx bx-cart fs-3 text-white'></i>
						</div>
					</div>
				
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Processing Orders</p>
					</div>
				</div>
			</div>
			</div>



			<div class="col">
				<div class="card radius-10 bg-gradient-ibiza">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$delivered_orders}} Order</h5>
						<div class="ms-auto">
							<i class='bx bx-cart fs-3 text-white'></i>
						</div>
					</div>
					
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Completed Orders</p>
					</div>
				</div>
			 </div>
			</div>


		</div><!--end row-->

		<div class="pb-3 pt-3" >
			<h4>Boutiques Reporting Cards</h4>
		</div>

		<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">


			<div class="col">
				<div class="card radius-10 bg-gradient-ohhappiness">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$pending_boutique_requests}} requests</h5>
						<div class="ms-auto">
							<i class='bx bx-group fs-3 text-white'></i>
						</div>
					</div>
					
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Pending Boutique Requests</p>
					</div>
				</div>
			</div>
			</div>



			<div class="col">
				<div class="card radius-10 bg-gradient-ohhappiness">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$active_boutiques}} boutiques</h5>
						<div class="ms-auto">
							<i class='bx bx-group fs-3 text-white'></i>
						</div>
					</div>
					
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Active Boutiques</p>
					</div>
				</div>
			</div>
			</div>



			<div class="col">
				<div class="card radius-10 bg-gradient-ohhappiness">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$rejected_boutique_requests}} Requests</h5>
						<div class="ms-auto">
							<i class='bx bx-group fs-3 text-white'></i>
						</div>
					</div>
					
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Rejected Boutiques Requests</p>
					</div>
				</div>
			</div>
			</div>



			<div class="col">
				<div class="card radius-10 bg-gradient-orange">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$customers}} Users</h5>
						<div class="ms-auto">
							<i class='bx bx-group fs-3 text-white'></i>
						</div>
					</div>
					
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Registerd Users</p>
					</div>
				</div>
			</div>
			</div>


		</div><!--end row-->



		 

</div>
		<!--end page wrapper -->



		

        @endsection