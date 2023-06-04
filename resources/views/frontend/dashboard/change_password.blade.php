@extends('dashboard')
@section('user')

    <div id="main">


        <div class="bg-light py-3">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">User Dashboard</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">Change Password</strong></div>
              </div>
            </div>
          </div>  

   <div class="site-section border-bottom" data-aos="fade">
     <div class="container">
       <div class="row mb-5 p-2">
  
           <div class="site-section-heading pt-3 mb-4">
           <h2 class="text-black">User Dashboard</h2>
           </div>
       </div>
          <div class="row mb-5">
       <div class="col-lg-4">
        @include('frontend.dashboard.dashboard_sidebar')

       </div>
              
              
       <div class="col-lg-8">
           <div class="tab-content">
               
                   <div class="accordion">
                    <div class="card">
                        <div class="card">
                                        <div class="card-header">
                                            <h5>Change Password</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{ route('user.update.password') }}">
                                                @csrf


                                                @if(session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{session('status')}}

                                </div>

                                @elseif(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('error')}}

                                </div>
                                @endif

             
                                                <div class="row">

                                                    <div class="form-group col-md-12">
                                                        <label>Old Password </label>
                                                        
                                                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="current_password" placeholder="Old Password" />
                        
                                                            @error('old_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>New Password</label>
                                                        
                                                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="New Password" />
                        
                                                            @error('new_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Confirm New Password </label>
                                                        <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" placeholder="Confirm New Password" />
                                                       
                                                    </div>

                                                    
                                                    
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>  
                    </div>

                   </div>
              
               
               
               


           </div>
       </div>
   </div>

   @endsection