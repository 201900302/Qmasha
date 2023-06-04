@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Shipping</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Shipping Areas <span class="badge rounded-pill bg-danger">{{ count($shippingAreas) }}</span></li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
		<a href="{{ route('add.shippingArea') }}" class="btn btn-primary">Add Shipping Area</a> 				 
		 				 
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
                <th>Country Name </th>
				<th>Shipping Cost</th> 
                <th>Cities</th>
                <th>status</th>
                <th>Action</th>
			</tr>
		</thead>
		<tbody>
	@foreach($shippingAreas as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
                <td>{{ $item->country_name }}</td>
                <td>{{ $item->shipping_cost }} BHD</td>
                {{-- <td>{{ $item->country_cities }}</td> --}}
                <td>
                        <select class="form-control unicase-form-control" id="cities" name="cities">
                            <option selected="" disabled="">Click To Load Cities</option>

                            @php
                                $city = $item->country_cities;
                                $country_cities = explode(',',$city);
                            @endphp
                        @foreach ($country_cities as $country_city)
                            <option value="{{$country_city}}">{{ucwords($country_city)}}</option>
                        @endforeach
              

                        </select>
                </td>

                <td>
                    {{-- if the product is active --}}
                    @if ($item->status == 1) 
                    <p class="budge rounded-pill bg-success pr-2 pl-2" style="text-align: center; color:white;">Delivary Actived</p>
                    @else
                    {{-- if the product is inactive --}}
                    <p class="budge rounded-pill bg-danger pr-2 pl-2" style="text-align: center; color:white;">Delivary Inactived </p>
                    @endif
                </td>
                
				<td>
<a href="{{ route('edit.shippingArea',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
<a href="{{ route('delete.shippingArea',$item->id) }}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
@if ($item->status == 1) 
<a href="{{ route('inactive.shippingArea',$item->id) }}" class="btn btn-secondary" title="inactive"><i class="fa-solid fa-truck"></i></a>
@else
                    {{-- if the product is inactive --}}
<a href="{{ route('active.shippingArea',$item->id) }}" class="btn btn-success" title="active"><i class="fa-solid fa-truck"></i></a>
@endif
				
				</td> 
			</tr>
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
                <th>Country Name </th>
				<th>Shipping Cost</th> 
                <th>Cities</th>
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