@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Manage Order Items</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Ready To Collect Order Items</li>
							</ol>
						</nav>
					</div>
					
                    
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
                <th>Order Invoice </th> 
				<th>Product Name </th>
                <th>Image </th>
				<th>Quantity</th>
                <th>Boutique Name</th> 
                <th>Vendor Name</th> 
                <th>Vendor Email/Phone</th> 
                <th>Vendor Address</th> 
                <th>Status</th> 
			</tr>
		</thead>
		<tbody>
	@foreach($orderItems as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item['order']['invoice_number'] }}</td>
                <td>{{ $item['product']['product_name'] }}</td>	
                <td><img src="{{ url($item['product']['product_thumbnail'])}}" style="height: 50px; width:50px;"></td>
                <td>{{ $item->qty }}</td>
                <td> {{$item['vendor']['boutiqueName']}}</td>
                <td>{{$item['vendor']['name']}}</td>
                <td>{{$item['vendor']['email']}}, {{$item['vendor']['phone']}}</td>
                <td>{{$item['vendor']['address']}}</td>
                <td>
                    @if($item->status == 'pending')
                    <p class="budge rounded-pill bg-warning" style="text-align: center; color:white;"> {{ $item->status }} </p>
                    @elseif($item->status == 'confirmed')
                    <p class="budge rounded-pill bg-primary" style="text-align: center; color:white;"> {{ $item->status }} </p>
                    @elseif($item->status == 'processing')
                    <p class="budge rounded-pill bg-info" style="text-align: center; color:white;"> {{ $item->status }} </p>
                    @elseif($item->status == 'ready')
                    <p class="budge rounded-pill bg-danger" style="text-align: center; color:white;"> {{ $item->status }}</p>
                    @elseif($item->status == 'delivered')
                    <p class="budge rounded-pill bg-success" style="text-align: center; color:white;"> {{ $item->status }} </p>
                    @elseif($item->status == 'cancelled')
                    <p class="budge rounded-pill bg-secondary" style="text-align: center; color:white;"> {{ $item->status }} </p>
                    @endif

                </td>
                
			</tr>
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
                <th>Order Invoice </th> 
				<th>Product Name </th>
                <th>Image </th>
				<th>Quantity</th>
                <th>Boutique Name</th> 
                <th>Vendor Name</th> 
                <th>Vendor Email/Phone</th> 
                <th>Vendor Address</th> 
                <th>Status</th> 
			</tr>
		</tfoot>
	</table>
						</div>
					</div>
				</div>
 
				 
			</div>
@endsection