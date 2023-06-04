@extends('dashboard')
@section('user')

    <div id="main">


        <div class="bg-light py-3">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">User Dashboard</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">Account Details</strong></div>
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
                                               <h5>Account Details</h5>
                                           </div>
                                           <div class="card-body">
                                            <form method="POST" action="{{ route('user.profile.store') }}">
                                                @csrf
                
                                                   <div class="row">

                                                       <div class="form-group col-md-6">
                                                           <label>User Name </label>
                                                           <input class="form-control" name="name" id="name" type="text" value="{{$userData->name}}"/>
                                                       </div>

                                                       <div class="form-group col-md-6">
                                                           <label>Email Address</label>
                                                           <input type="email" class="form-control" name="email" id="email" value="{{$userData->email}}"/>
                                                       </div>

                                                       <div class="form-group col-md-12">
                                                           <label>Phone Number </label>
                                                           <input class="form-control" name="phone" id="phone" type="text" value="{{$userData->phone}}"/>
                                                       </div>

                                                       <div class="form-group col-md-12">
                                                           <label>Address </label>
                                                           <input class="form-control" name="address" id="address" type="text"  value="{{$userData->address}}"/>
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