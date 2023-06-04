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
                                        <form method="POST" action="{{route('search.by.date')}}">
                                            @csrf
                                            <h5 class="card-title">Search By Date</h5>
                                            <div class="row">   
                                            <div class="col-md-6 p-2">
                                            <label class="form-label">From: </label>
                                            <input type="date" name="from_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 p-2">
                                                <label class="form-label">To: </label>
                                                <input type="date" name="to_date" class="form-control">
                                                </div>
                                            </div>
                                            <br>
                                            <input type="submit" class="btn btn-rounded btn-primary" value="Search">
                                        </form>
                                 </div>
                                </div>
                            </div>
                            
                        
                            
                            <div class="col">
                                
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Search By Month</h5>
                                        <form method="POST" action="{{route('search.by.month')}}">
                                            @csrf
                                            <div class="row">   

                                            <div class="col-md-6 p-2">
                                            <label class="form-label">Select Month: </label>
                                            <select name="month" class="form-select mb-3" aria-label="Select a month">
                                                <option value="">Select Month</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                            </div>
                                            

                                            <div class="col-md-6 p-2">
                                            <label class="form-label">Select Year: </label>
                                            <select name="year_month" class="form-select mb-3" aria-label="Select a Year">
                                                <option value="">Select Year</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                            
                                            </select>
                                            </div>
                                            </div>
                                            
                                            <input type="submit" class="btn btn-rounded btn-primary mb-1" value="Search">
                                        </form>
                                    </div>
                                </div>
                            </div>
                       


                        
                        <div class="col">
                            
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Search By Year</h5>
                                    <form method="POST" action="{{route('search.by.year')}}">
                                        @csrf
                                    <div class="row">   

                

                                    <div class="col-md-12 p-2">
                                    <label class="form-label">Select Year: </label>
                                    <select name="year" class="form-select mb-3" aria-label="Select a Year">
                                        <option value="">Select Year</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        
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