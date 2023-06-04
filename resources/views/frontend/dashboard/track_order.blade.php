@extends('dashboard')
@section('user')

    <div id="main">


        <div class="bg-light py-3">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">User Dashboard</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">Track Order</strong></div>
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
                                            <h5>Track Order</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{ route('user.order.tracking') }}">
                                                @csrf
             
                                                <div class="row">

                                                    <div class="form-group col-md-12">
                                                        <label>Enter the order invoice Id: </label>
                                                        
                                                            <input type="text" name="invoice" class="form-control" id="invoice" placeholder="invoice number" required/>
                        
                                                            @error('old_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        
                                                    </div>
                                                    
                                                    
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit">Track Order</button>
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