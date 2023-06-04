@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Reports</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('active.boutique')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Boutiques Report</li>
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
                
                <th>Logo</th>
				<th>Boutique Name </th>
				<th>Vendor Name</th>
                <th>Email</th>
                <th>Join Date</th>
                <th>Status</th>
                <th>Action</th> 
			</tr>
		</thead>
		<tbody>
	@foreach($users as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
                
                <td><img src="{{ (!empty($item->photo)) ? url('uploud/vendor_images/'.$item->photo): url('images/icons/person-circle-white.svg') }}" width="70" height="70"></td>
				<td>{{ $item->boutiqueName }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->vendor_join_date }}</td>
                <td>
                    @if ($item->status == 'inactive')
                    <p class="budge rounded-pill bg-warning" style="text-align: center; color:white;"> {{ $item->status }} </p>
                    @elseif ($item->status == 'active')
                    <p class="budge rounded-pill bg-success" style="text-align: center; color:white;"> {{ $item->status }} </p>
                    @elseif ($item->status == 'rejected')
                    <p class="budge rounded-pill bg-danger" style="text-align: center; color:white;"> {{ $item->status }} </p>
                    @endif
                </td>		


				<td>
                    <a href="{{ route('view.boutiqueDetails',$item->id) }}" class="btn btn-primary text-light" title="view Details"><i class="fa fa-eye"></i></a>
                    @if ($item->status == 'active')
                    <a href="{{ route('admin.selected.vendor.products',$item->id) }}" class="btn btn-info text-light">Products</a>
                    @else
                    @endif
               </td>

		
			</tr>
			
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
				<th>Boutique Name </th>
				<th>Vendor Name</th>
                <th>Email</th>
                <th>Join Date</th>
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