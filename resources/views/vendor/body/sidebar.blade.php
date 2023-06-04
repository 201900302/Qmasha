@php
//take the auth id
$id = Auth::user()->id;
$vendorId = App\Models\User::findOrFail($id);
$status = $vendorId->status;
@endphp

<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('images/logoTransparent.png')}}" style="height: 50px" alt="logo icon">
				</div>

				
				
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
				
				
			</div>
			
			<!--navigation-->
			<ul class="metismenu" id="menu">

				<li>
					<a href="{{route('vendor.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>




				@if ($status == 'active')
				
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Manage Products</div>
					</a>
					<ul>
						<li> <a href="{{ route('vendor.all.products') }}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
						</li>
						<li> <a href="{{route('vendor.add.product')}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
						</li>
						
					</ul>
				</li>


				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Manage Orders</div>
					</a>
					<ul>
						
						<li> 
							<a href="{{route('vendor.order.all')}}"><i class="bx bx-right-arrow-alt"></i>All Orders</a>
						</li>

						<li> 
							<a href="{{route('vendor.order.pending')}}"><i class="bx bx-right-arrow-alt"></i>Pending Orders</a>
						</li>

						<li> 
							<a href="{{route('vendor.order.processing')}}"><i class="bx bx-right-arrow-alt"></i>Processing Orders</a>
						</li>

						<li> 
							<a href="{{route('vendor.order.ready')}}"><i class="bx bx-right-arrow-alt"></i>Ready Orders</a>
						</li>

						<li> 
							<a href="{{route('vendor.order.delivered')}}"><i class="bx bx-right-arrow-alt"></i>Delivered Orders</a>
						</li>

						<li> 
							<a href="{{route('vendor.order.cancelled')}}"><i class="bx bx-right-arrow-alt"></i>Cancelled Orders</a>
						</li>

					</ul>
				</li>


				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Manage Reviews</div>
					</a>
					<ul>			
						<li> 
							<a href="{{route('vendor.reviews.all')}}"><i class="bx bx-right-arrow-alt"></i>All Reviews</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Manage Stock</div>
					</a>
					<ul>			
						<li> 
							<a href="{{route('vendor.stock.all')}}"><i class="bx bx-right-arrow-alt"></i>View Products Stock</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="{{route('vendor.join.poster')}}"class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Poster</div>
					</a>
					
				</li>

			</ul>
				
			@else
				
			@endif
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->