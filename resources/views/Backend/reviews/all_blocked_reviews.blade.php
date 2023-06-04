@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Reviews</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Blocked Product Reviews <span class="badge rounded-pill bg-danger">{{ count($reviews) }}</span></li>
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
                <th>Comment </th>
                <th>Rate </th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>User Email</th>
                <th>status</th>
                <th>Action</th>
			</tr>
		</thead>
		<tbody>
	@foreach($reviews as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
                <td>{{ Str::limit($item->comment, 100) }}</td>
                <td>
                    @if($item->rate == null)
                    <i class="bx bxs-star text-secondary"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    @elseif($item->rate == 1)
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    @elseif($item->rate == 2)
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    @elseif($item->rate == 3)
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    @elseif($item->rate == 4)
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-secondary"></i>
                    @elseif($item->rate == 5)
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-warning"></i>
                    <i class="bx bxs-star text-warning"></i>
                    @else
                    @endif
                </td>
                <td>{{ $item['product']['product_name'] }}</td>
                <td><img src="{{ asset($item['product']['product_thumbnail'] ) }}" style="width: 80px; height:100px;" ></td>
				<td>{{ $item['user']['email'] }}</td>
                <td>
                    {{-- if the review is active --}}
                    @if ($item->status == 1) 
                    <p class="budge rounded-pill bg-success pr-2 pl-2" style="text-align: center; color:white;">Active</p>
                    @else
                    {{-- if the review is blocked --}}
                    <p class="budge rounded-pill bg-danger pr-2 pl-2" style="text-align: center; color:white;">Blocked</p>
                    @endif
                </td>

                
				<td>
                    @if ($item->status == 1) 
                    <a href="{{ route('admin.block.review',$item->id) }}" class="btn btn-danger" title="block"><i class="fa fa-times" aria-hidden="true"></i></a>
                    @else
                    <a href="{{ route('admin.publish.review',$item->id) }}" class="btn btn-success" title="activate"><i class="fa fa-check" aria-hidden="true"></i></a>
                    @endif
				
				</td> 
			</tr>
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
                <th>Comment </th>
                <th>Rate </th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>User Email</th>
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