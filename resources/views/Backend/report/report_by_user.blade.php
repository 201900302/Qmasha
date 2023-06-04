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
								<li class="breadcrumb-item active" aria-current="page">E-commerce Report System</li>
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
				

                        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
                        <div class="col">
                            
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Search By User</h5>
                                    <form method="POST" action="{{route('search.by.user')}}">
                                        @csrf
                                    <div class="row">   

                

                                    <div class="col-md-12 p-2">
                                    <label class="form-label">Select User: </label>
                                    <select name="user" class="form-select mb-3" aria-label="Select a User">
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->email}}</option>
        
                                        @endforeach
                                        
                                        
                                        
                                    </select>
                                    </div>
                                    </div>
                                    <input type="submit" class="btn btn-rounded btn-primary mb-1" value="Search">
                                    </form>
                                </div>
                            </div>
                        </div>
                        


                        </div>




					
 
				 
</div>




@endsection