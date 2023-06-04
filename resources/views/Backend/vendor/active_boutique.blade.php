@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Active Boutiques</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('active.boutique')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Active Boutiques</li>
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
                <th>Vnedor ID </th>
				<th>Boutique Name </th>
				<th>Vendor User Name</th>
                <th>Email</th>
                <th>Join Date</th>
                <th>Status</th>
                <th>Details</th> 
				<th>Boutique`s Products</th> 
			</tr>
		</thead>
		<tbody>
	@foreach($activeBoutique as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
                <td>#{{ $item->id }}</td>
				<td>{{ $item->boutiqueName }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->vendor_join_date }}</td>
                <td>{{ $item->status }}</td>

				<td>
                    <a href="{{ route('view.boutiqueDetails',$item->id) }}" class="btn btn-info">View More Details</a>
               </td>

				{{-- <td>
                    <a href="{{ route('deactive.boutique.approve',$item->id) }}" class="btn btn-danger" >Deactivate</a>
                </td> 
 --}}
				<td>
                    <a href="{{ route('admin.selected.vendor.products',$item->id) }}" class="btn btn-info">Products</a>
                </td> 
			</tr>
			
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
                <th>Vnedor ID </th>
				<th>Boutique Name </th>
				<th>Vendor User Name</th>
                <th>Email</th>
                <th>Join Date</th>
                <th>Status</th>
                <th>Details</th> 
				<th>Boutique`s Products</th> 
			</tr>
		</tfoot>
	</table>
						</div>
					</div>
				</div>
 
				 
			</div>
@endsection