@extends('dashboard')
@section('user')

    <div id="main">


        <div class="bg-light py-3">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">User Dashboard</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">My Orders</strong></div>
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
                                               <h3 class="mb-0">Your Orders</h3>
                                           </div>
                                           <div class="card-body">
                                               <div class="table-responsive">
                                                   <table class="table">
                                                       <thead>
                                                           <tr>
                                                               <th>Sl</th>
                                                               <th>Date</th>
                                                               <th>Invoice No</th>
                                                               <th>Total</th>
                                                               <th>Status</th>
                                                               <th>Action</th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                        @foreach ($orders as $key => $order)
                                                            
                                                        
                                                           <tr>
                                                               <td>{{$key+1}}</td>
                                                               <td>{{$order->order_date}}</td>
                                                               <td>{{$order->invoice_number}}</td>
                                                               <td>{{$order->amount}} BHD</td>
                                                               <td>
                                                                @if($order->status == 'pending')
                                                                <p class="badge badge-pill badge-warning" style="text-align: center; color:white;"> {{ $order->status }} </p>
                                                                @elseif($order->status == 'confirmed')
                                                                <p class="badge badge-pill badge-info" style="text-align: center; color:white;"> {{ $order->status }} </p>
                                                                @elseif($order->status == 'processing')
                                                                <p class="badge badge-pill badge-danger" style="text-align: center; color:white;"> {{ $order->status }} </p>
                                                                @elseif($order->status == 'delivered')
                                                                <p class="badge badge-pill badge-success" style="text-align: center; color:white;"> {{ $order->status }} </p>
                                                                @elseif($order->status == 'cancelled')
                                                                <p class="badge badge-pill badge-secondary" style="text-align: center; color:white;"> {{ $order->status }} </p>
                                                                @endif
                                                                </td>
                                                                <td>
                                                                @if($order->status == 'pending')
                                                                <a href="{{url('user/order/cancel/'.$order->id)}}" class="btn-sm btn-danger" id="cancelorder">Cancel Order</a> 
                                                                @endif
                                                                <a href="{{ url('user/order-details/'.$order->id) }}" class="btn-sm btn-primary" >View</a>  
                                                                <a href="{{url('user/order-download/'.$order->id)}}" class="btn-sm btn-secondary"><i class="fa fa-download"></i></a> 
                                                                </td>
                                                           </tr>
                                                           @endforeach
                                                        
                                            
                                                       </tbody>
                                                   </table>
                                               </div>
                                           </div>
                                       </div>
                       </div>

                   </div>
               
               
               
           </div>
       </div>
   </div>

   @endsection