@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Coupon System</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Active Coupons <span class="badge rounded-pill bg-danger">{{ count($coupons) }}</span></li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
		                    <a href="{{ route('add.coupon') }}" class="btn btn-primary">Add Coupon</a> 
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
                <th>Coupon Code</th>
                <th>Discount</th>
                <th>Valid Until</th>
                <th>status</th>
                <th>Action</th>
			</tr>
		</thead>
		<tbody>
	@foreach($coupons as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item->coupon_code }}</td>
                <td>{{ $item->coupon_discount}} %</td>
                <td>{{ Carbon\Carbon::parse($item->coupon_validity_date)->format('d/m/Y') }}</td>
                <td>
                    {{-- if the product is active --}}
                    @if ($item->status == 1 && $item->coupon_validity_date >= Carbon\Carbon::now()->format('Y-m-d') ) 
                    <p class="budge rounded-pill bg-success pr-2 pl-2" style="text-align: center; color:white;">Active</p>
                    @elseif ($item->coupon_validity_date < Carbon\Carbon::now()->format('Y-m-d')) 
                    <p class="budge rounded-pill bg-secondary pr-2 pl-2" style="text-align: center; color:white;">Expired</p>
                    @elseif($item->status == 0)
                    {{-- if the product is inactive --}}
                    <p class="budge rounded-pill bg-danger pr-2 pl-2" style="text-align: center; color:white;"> Inactive </p>
                    @endif
                </td>
                
                
				<td>
                    @if ($item->status == 1 && $item->coupon_validity_date >= Carbon\Carbon::now()->format('Y-m-d')) 
                    <a href="{{ route('inactive.coupon',$item->id) }}" class="btn btn-danger" title="inactivate"><i class="fa fa-thumbs-down"></i></a>
					<a href="{{ route('get.coupon.poster',$item->id) }}" class="btn btn-primary" title="poster"><i class="fa fa-download"></i></a>
                    @elseif ($item->status == 0 && $item->coupon_validity_date >= Carbon\Carbon::now()->format('Y-m-d')) 
                    <a href="{{ route('active.coupon',$item->id) }}" class="btn btn-success" title="activate"><i class="fa fa-thumbs-up"></i></a>
                    @endif
                    <a href="{{ route('edit.coupon',$item->id) }}" class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"></i></a>
                    <a href="{{ route('delete.coupon',$item->id) }}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
                    
				</td> 
                
                
				
			</tr>
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
                <th>Coupon Code</th>
                <th>Discount</th>
                <th>Valid Until</th>
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