@extends('dashboard')
@section('user')

    <div id="main">


        <div class="bg-light py-3">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">User Dashboard</strong></div>
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
           {{-- <div class="nav nav-pills faq-nav">

               <a href="{{route('dashboard')}}" class="nav-link active">
                 Dashboard
               </a>

               <a href="{{route('user.orders.page')}}" class="nav-link" >
                   <span class="icon-shopping-bag"></span> Orders
               </a>

               <a href="#tab3" class="nav-link" >
                   <span class="icon-truck"></span> Track My Order
               </a>

               <a href="#tab4" class="nav-link" >
                   <span class="icon-truck"></span> My Address
                   
               </a>

               <a href="{{route('user.account.page')}}" class="nav-link">
                   <span class="icon-account_circle"></span> Account Details
                   
               </a><!-- comment -->

               <a  href="{{route('user.change.password')}}" class="nav-link" >
                <span class="icon-key"></span> Change Password
                
            </a>

               <a href="{{ route('user.logout') }}" class="nav-link">
                Logout
               </a>
               
           </div> --}}
           
           
       </div>
              
              
       <div class="col-lg-8">
           <div class="tab-content" id="faq-tab-content">




               <div class="tab-pane show active">
                   
                       <div class="card">
                                           <div class="card-header">
                                               <h3 class="mb-0">Hello {{ Auth::user()->name }}</h3>
                                           </div>
                                           <div class="card-body">
                                               <p>
                                                   From your account dashboard. you can easily check and view your <a href="{{route('user.orders.page')}}">orders</a>,<br />
                                                   manage your <a href="{{route('user.account.page')}}">account</a> and <a href="{{route('user.change.password')}}">edit your password.</a>
                                               </p>
                                           </div>
                       </div>

                   
               </div>




             
               
               


           </div>
       </div>
   </div>

   @endsection