@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Manage Orders</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Processing Orders</li>
							</ol>
						</nav>
					</div>
					{{-- <div class="ms-auto">
						<div class="btn-group">
		<a href="{{ route('add.category') }}" class="btn btn-primary">Add Category</a> 				 
		 				 
						</div>
					</div> --}}
				</div>
				<!--end breadcrumb-->
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
				<th>Amount</th> 
                <th>Payment</th> 
                <th>Status</th> 
                <th>Action</th> 
			</tr>
		</thead>
		<tbody>
	@foreach($orders as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item->order_date }}</td>
                <td>{{ $item->invoice_number }}</td>	
                <td>{{ $item->amount }} BHD</td>
                <td>{{ $item->payment_method }}</td>	
                <td>
                    <p class="budge rounded-pill bg-danger" style="text-align: center; color:white;"> {{ $item->status }} </p>
                </td>
                

				<td>
                <a href="{{route('admin.order.details', $item->id)}}" class="btn btn-info" title="details"><i class="fa fa-eye"></i></a>
				<a href="{{route('admin.download.order.details', $item->id)}}" class="btn btn-secondary" title="download pdf"><i class="fa fa-download"></i></a>

				</td> 
			</tr>
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
				<th>Date </th>
				<th>Invoice</th>
				<th>Amount</th> 
                <th>Payment</th> 
                <th>Status</th> 
                <th>Action</th> 
			</tr>
		</tfoot>
	</table>
						</div>
					</div>
				</div>
 
				 
			</div>
@endsection