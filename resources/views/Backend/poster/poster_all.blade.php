@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Annoucements</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Annoucements <span class="badge rounded-pill bg-danger">{{ count($posters) }}</span></li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
		<a href="{{ route('add.poster') }}" class="btn btn-primary">Add Annoucements</a> 				 
		 				 
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
                <th>Title</th>
                <th>Body</th>
				<th>URL</th>
                <th>Status</th>
                <th>Action</th>
			</tr>
		</thead>
		<tbody>
	@foreach($posters as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item->poster_title }}</td>
                <td>{{ Str::limit($item->poster_body, 50, '....') }}</td>
                <td>{{ Str::limit($item->poster_url, 30, '....') }}</td>
                


                <td>
                    {{-- if the Annoucement is active --}}
                    @if ($item->status == 1) 
                    <p class="budge rounded-pill bg-success pr-2 pl-2" style="text-align: center; color:white;">Active</p>
                    @else
                    {{-- if the Annoucement is inactive --}}
                    <p class="budge rounded-pill bg-danger pr-2 pl-2" style="text-align: center; color:white;"> Inactive </p>
                    @endif
                </td>

                
				<td>
@if ($item->status == 1) 
<a href="{{ route('inactive.poster',$item->id) }}" class="btn btn-success" title="inactive"><i class="fa fa-thumbs-up"></i></a>
@else
<a href="{{ route('active.poster',$item->id) }}" class="btn btn-secondary" title="active"><i class="fa fa-thumbs-up"></i></i></a>
@endif
<a href="{{ route('view.poster',$item->id) }}" class="btn btn-warning" title="view"><i class="fa fa-eye"></i></a>
<a href="{{ route('edit.poster',$item->id) }}" class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
<a href="{{ route('delete.poster',$item->id) }}" class="btn btn-danger" id="delete" title="Delete"><i class="fa fa-trash"></i></a>

				
				</td> 
			</tr>
			@endforeach
			 
		 
		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
                <th>Title</th>
                <th>Body</th>
				<th>URL</th>
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