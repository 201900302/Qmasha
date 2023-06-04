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
					<a href="{{route('admin.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>

{{-- category  --}}
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Category</div>
					</a>
					<ul>
						<li> 
							<a href="{{route('all.category')}}"><i class="bx bx-right-arrow-alt"></i>All Categories</a>
						</li>
						<li> 
							<a href="{{route('add.category')}}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
						</li>
					</ul>
				</li>


{{-- sub category --}}
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Sub-Category</div>
					</a>
					<ul>
						<li> 
							<a href="{{route('all.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>All Sub Categories</a>
						</li>
						<li> 
							<a href="{{route('add.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>Add Sub Category</a>
						</li>
					</ul>
				</li>

{{-- coupon --}}
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Coupon System</div>
					</a>
					<ul>
						<li> 
							<a href="{{route('add.coupon')}}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
						</li>
						<li> 
							<a href="{{route('all.coupon')}}"><i class="bx bx-right-arrow-alt"></i>All Coupons</a>
						</li>
						<li> 
							<a href="{{route('all.active.coupon')}}"><i class="bx bx-right-arrow-alt"></i>All Active Coupons</a>
						</li>
						<li> 
							<a href="{{route('all.inactive.coupon')}}"><i class="bx bx-right-arrow-alt"></i>All Inactive Coupons</a>
						</li>
						<li> 
							<a href="{{route('all.expired.coupon')}}"><i class="bx bx-right-arrow-alt"></i>All Expired Coupons</a>
						</li>
					</ul>
				</li>


				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Shipping</div>
					</a>
					<ul>
						<li> 
							<a href="{{route('add.shippingArea')}}"><i class="bx bx-right-arrow-alt"></i>Add Shipping Area</a>
						</li>
						<li> 
							<a href="{{route('all.shippingArea')}}"><i class="bx bx-right-arrow-alt"></i>All Shipping Areas</a>
						</li>
						<li> 
							<a href="{{route('all.active.shippingArea')}}"><i class="bx bx-right-arrow-alt"></i>Active Shipping Areas</a>
						</li>
						<li> 
							<a href="{{route('all.inactive.shippingArea')}}"><i class="bx bx-right-arrow-alt"></i>Inactive Shipping Areas</a>
						</li>
			
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Manage Annoucements</div>
					</a>
					<ul>
						<li> 
							<a href="{{ route('all.poster') }}"><i class="bx bx-right-arrow-alt"></i>All Annoucements</a>
						</li>
						<li> 
							<a href="{{ route('add.poster') }}"><i class="bx bx-right-arrow-alt"></i>Add Annoucements</a>
						</li>
						
					</ul>
				</li>


				
				
				
				
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Manage Boutiques</div>
					</a>
					<ul>
						<li> 
							<a href="{{ route('inactive.boutique') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Boutiques</a>
						</li>
						<li> 
							<a href="{{ route('active.boutique') }}"><i class="bx bx-right-arrow-alt"></i>Active Boutiques</a>
						</li>
						<li> 
							<a href="{{ route('rejected.boutique') }}"><i class="bx bx-right-arrow-alt"></i>Rejected Boutiques</a>
						</li>
						
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Manage Products</div>
					</a>
					<ul>
						<li> 
							<a href="{{ route('admin.all.products') }}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
						</li>
						<li> 
							<a href="{{ route('admin.favourite.products') }}"><i class="bx bx-right-arrow-alt"></i>Favourited Products</a>
						</li>
						{{-- <li> <a href="{{ route('active.boutique') }}"><i class="bx bx-right-arrow-alt"></i>Active Boutiques</a>
						</li>
						<li> <a href="{{ route('rejected.boutique') }}"><i class="bx bx-right-arrow-alt"></i>Rejected Boutiques</a>
						</li> --}}
						
					</ul>
				</li>


				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Manage Reviews</div>
					</a>
					<ul>
						<li> 
							<a href="{{ route('all.published.reviews') }}"><i class="bx bx-right-arrow-alt"></i>All Published Reviews</a>
						</li>

						<li> 
							<a href="{{ route('all.blocked.reviews') }}"><i class="bx bx-right-arrow-alt"></i>All Blocked Reviews</a>
						</li>
					</ul>
				</li>


				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Manage Orders</div>
					</a>
					<ul>
						<li> 
							<a href="{{ route('all.order') }}"><i class="bx bx-right-arrow-alt"></i>All Orders</a>
						</li>

						<li> 
							<a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending Orders</a>
						</li>

						<li> 
							<a href="{{ route('confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed Orders</a>
						</li>

						<li> 
							<a href="{{ route('processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing Orders</a>
						</li>

						<li> 
							<a href="{{ route('delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered Orders</a>
						</li>

						<li> 
							<a href="{{ route('cancelled.order') }}"><i class="bx bx-right-arrow-alt"></i>Cancelled Orders</a>
						</li>
						
						
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Manage Order Items</div>
					</a>
					<ul>
						<li> 
							<a href="{{ route('all.ready.order.items') }}"><i class="bx bx-right-arrow-alt"></i>Ready To Collect Items</a>
						</li>
						
					</ul>
				</li>

				

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Reports</div>
					</a>
					<ul>
						<li> 
							<a href="{{ route('report.view') }}"><i class="bx bx-right-arrow-alt"></i>Search Orders</a>
						</li>

						<li> 
							<a href="{{ route('order.by.user') }}"><i class="bx bx-right-arrow-alt"></i>Orders By User</a>
						</li>
						
						
						
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Users Reports</div>
					</a>
					<ul>
						<li> 
							<a href="{{ route('report.all.user') }}"><i class="bx bx-right-arrow-alt"></i>All Users</a>
						</li>

						<li> 
							<a href="{{ route('report.all.vendor') }}"><i class="bx bx-right-arrow-alt"></i>All Boutiques</a>
						</li>
						
						
						
					</ul>
				</li>
				
				
				
				
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->