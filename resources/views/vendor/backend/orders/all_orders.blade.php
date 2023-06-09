@extends('vendor.vendor_dashboard')
@section('vendor')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Manage Orders</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Orders</li>
							</ol>
						</nav>
					</div>
					
				</div>
				
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
			<tr>
				<th>Sl</th>
				<th>Date </th>
				<th>Invoice</th> 
                {{-- <th>Status</th>  --}}
				
                <th>Action</th> 
			</tr>
		</thead>
		<tbody>
			@php
			$displayedOrder = "";
			@endphp
			@foreach($orderItems as $key => $item)	
			
			@if($item['order']['invoice_number'] == $displayedOrder)
		
			@else
		
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item['order']['order_date'] }}</td>
				<td>{{ $item['order']['invoice_number'] }}</td>	
			  
				<td>
					<a href="{{route('vendor.order.details', $item->order->id)}}" class="btn btn-info" title="details"><i class="fa fa-eye"></i></a>
			</td> 
			</tr>
			
			@php
			$displayedOrder = $item['order']['invoice_number'];
			@endphp
		
			@endif
					
			@endforeach
					 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
				<th>Date </th>
				<th>Invoice</th> 
                {{-- <th>Status</th> --}}
				
                <th>Action</th>  
			</tr>
		</tfoot>
	</table>
						</div>
					</div>
				</div>
 
				 
			</div>
@endsection