@extends('vendor.vendor_dashboard')
@section('vendor')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Manage Stock</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Products <span class="badge rounded-pill bg-danger">{{ count($products) }}</span></li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				 

                {{-- <H6>Product List <span class="badge rounded-pill bg-danger">{{ count($products) }}</span></H6> --}}


				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
			<tr>
				<th>Sl</th>
                {{-- x --}}
				<th>Product Image </th>
                <th>Product Name </th>
				<th>Quantity</th> 
                {{-- <th>Price</th>
                <th>Discount Price</th> --}}
                <th>status</th>
                {{-- <th>Action</th> --}}
			</tr>
		</thead>
		<tbody>
	@foreach($products as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
				{{-- <td>{{ $item->id }}</td> --}}
				<td> <img src="{{ asset($item->product_thumbnail) }}" style="width: 80px; height:100px;" >  </td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->product_qty }}</td>
                {{-- <td>{{ $item->selling_price }}</td> --}}


                {{-- <td>
                    @if ($item->discount_price == null || $item->discount_price == 0)
                    <p class="budge rounded-pill bg-info pr-2 pl-2" style="text-align: center; color:white;">No Discount</p>
                    @else
                    @php
                        $amount = $item->selling_price - $item->discount_price;
                        $discount = ($amount/$item->selling_price) * 100;
                    @endphp
                    <p class="budge rounded-pill bg-danger" style="text-align: center; color:white;">{{round($discount)}}%</p>
                    @endif
                    
                </td> --}}



                <td>
                    {{-- if the product is active --}}
                    @if ($item->status == 1) 
                    <p class="budge rounded-pill bg-success pr-2 pl-2" style="text-align: center; color:white;">Active</p>
                    @else
                    {{-- if the product is inactive --}}
                    <p class="budge rounded-pill bg-danger pr-2 pl-2" style="text-align: center; color:white;"> Inactive </p>
                    @endif
                </td>
                
				
			</tr>
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
                {{-- <th>Product ID </th> --}}
				<th>Product Image </th>
                <th>Product Name </th>
				<th>Quantity</th> 
                {{-- <th>Price</th>
                <th>Discount Price</th> --}}
                <th>status</th>
                {{-- <th>Action</th> --}}
			</tr>
		</tfoot>
	</table>
						</div>
					</div>
				</div>
 
				 
			</div>
@endsection