@extends('vendor.vendor_dashboard')
@section('vendor')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Products</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Products <span class="badge rounded-pill bg-danger">{{ count($products) }}</span></li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
		<a href="{{ route('vendor.add.product') }}" class="btn btn-primary">Add Product</a> 				 
		 				 
						</div>
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
                <th>Product ID </th>
				<th>Product Image </th>
                <th>Product Name </th>
				<th>Quantity</th> 
                <th>Price</th>
                <th>Discount Price</th>
                <th>status</th>
                <th>Action</th>
			</tr>
		</thead>
		<tbody>
	@foreach($products as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item->id }}</td>
				<td> <img src="{{ asset($item->product_thumbnail) }}" style="width: 80px; height:100px;" >  </td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->product_qty }}</td>
                <td>{{ $item->selling_price }}</td>


                <td>
                    @if ($item->discount_price == null || $item->discount_price == 0)
                    <p class="budge rounded-pill bg-info pr-2 pl-2" style="text-align: center; color:white;">No Discount</p>
                    @else
                    @php
                        $amount = $item->selling_price - $item->discount_price;
                        $discount = ($amount/$item->selling_price) * 100;
                    @endphp
                    <p class="budge rounded-pill bg-danger" style="text-align: center; color:white;">{{round($discount)}}%</p>
                    @endif
                    
                </td>



                <td>
                    {{-- if the product is active --}}
                    @if ($item->status == 1) 
                    <p class="budge rounded-pill bg-success pr-2 pl-2" style="text-align: center; color:white;">Active</p>
                    @else
                    {{-- if the product is inactive --}}
                    <p class="budge rounded-pill bg-danger pr-2 pl-2" style="text-align: center; color:white;"> Inactive </p>
                    @endif
                </td>
                
				<td>
<a href="{{ route('vendor.edit.product',$item->id) }}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"></i></a>
<a href="{{ route('vendor.delete.product',$item->id) }}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
{{-- <a href="#" class="btn btn-warning" title="Details Page"><i class="fa fa-eye"></i></a> --}}
@if ($item->status == 1) 
<a href="{{ route('vendor.product.inactive',$item->id) }}" class="btn btn-primary" title="inactive"><i class="fa-solid fa-thumbs-down"></i></a>
@else
                    {{-- if the product is inactive --}}
<a href="{{ route('vendor.product.active',$item->id) }}" class="btn btn-primary" title="active"><i class="fa-solid fa-thumbs-up"></i></a>
@endif
				
				</td> 
			</tr>
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
                <th>Product ID </th>
				<th>Product Image </th>
                <th>Product Name </th>
				<th>Quantity</th> 
                <th>Price</th>
                <th>Discount Price</th>
                <th>status</th>
                <th>Action</th>
			</tr>
		</tfoot>
	</table>
						</div>
					</div>
				</div>
 
				 
			</div>
@endsection