@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Reports</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Users Report</li>
							</ol>
						</nav>
					</div>

                    {{-- <div class="ms-auto">
						<div class="btn-group">
                            <a href="{{ route('order.by.user') }}" class="btn btn-primary">Back To User Reports</a>
						</div>
					</div> --}}
					
				</div>
				<!--end breadcrumb-->
				<hr/>
				<div class="card">
                    {{-- <div class="card-header">
                    <h5>All Orders For User Id: <span class="text-primary">{{$user_id}}</span> / Email: <span class="text-primary">{{$user_email}}</span></h5>
                    </div> --}}

					<div class="card-body">

						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
			<tr>
				<th>Sl</th>
				<th>Name </th>
				<th>Email</th>
				<th>Phone</th> 
                {{-- <th>Address</th>  --}}
                <th>Status</th> 
                <th>Orders No</th> 
                <th>Action</th> 
			</tr>
		</thead>
		<tbody>
	@foreach($users as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>	
                <td>{{ $item->phone }} BHD</td>
                {{-- <td>{{ $item->address }}</td> --}}
                <td>
                    @if ($item->UserIsOnline())
                    <p class="budge rounded-pill bg-success" style="text-align: center; color:white;"> Active Now</p>
                    @else
                    <p class="budge rounded-pill bg-secondary" style="text-align: center; color:white;"> Last Seen: {{Carbon\Carbon::parse($item->last_seen)->diffForHumans()}}</p>
                    @endif
            
                </td>		
                @php
                    $orders = App\Models\Order::where('user_id', $item->id)->latest()->get();
                @endphp
                <td>
                    @if(count($orders) <= 1)
                    No Orders Fount
                    @else
                    {{count($orders)}} orders
                    @endif
                </td>
				<td>
                    @if(count($orders) > 0)
                    <a href="{{route('report.all.user.order', $item->id)}}" class="btn btn-warning  text-light" title="View Orders"><i class="fa fa-shopping-cart"></i></a>
                    @else
                    @endif
				</td> 
			</tr>
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
				<th>Name </th>
				<th>Email</th>
				<th>Phone</th> 
                {{-- <th>Address</th>  --}}
                <th>Status</th> 
                <th>Orders No</th> 
                <th>Action</th> 
			</tr>
		</tfoot>
	</table>
						</div>
					</div>
				</div>
 
				 
			</div>
@endsection