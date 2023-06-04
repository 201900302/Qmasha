@extends('dashboard')
@section('user')
<style type="text/css">
    
    
    .card{
        position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem}
        .card-header:first-child{border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0}
        .card-header{padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1)}
        .track{position: relative;background-color: #ddd;height: 7px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-bottom: 60px;margin-top: 50px}
        .track .step{-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -18px;text-align: center;position: relative}
        .track .step.active:before{background: #DFBD69}
        .track .step::before{height: 7px;position: absolute;content: "";width: 100%;left: 0;top: 18px}
        .track .step.active .icon{background: #926F34;color: #fff}
        .track .icon{display: inline-block;width: 40px;height: 40px;line-height: 40px;position: relative;border-radius: 100%;background: #ddd}
        .track .step.active .text{font-weight: 400;color: #000}
        .track .text{display: block;margin-top: 7px}
        .itemside{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%}
        .itemside .aside{position: relative;-ms-flex-negative: 0;flex-shrink: 0}
        .img-sm{width: 80px;height: 80px;padding: 7px}
        ul.row, ul.row-sm{list-style: none;padding: 0}
        .itemside .info{padding-left: 15px;padding-right: 7px}
        .itemside .title{display: block;margin-bottom: 5px;color: #212529}
        p{margin-top: 0;margin-bottom: 1rem}
        .btn-warning{color: #ffffff;background-color: #DFBD69;border-color: #DFBD69;border-radius: 1px}
        .btn-warning:hover{color: #ffffff;background-color: #926F34;border-color: #926F34;border-radius: 1px}

        .trackIcon {color: #DFBD69}
</style>
    <div id="main">


        <div class="bg-light py-3">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">User Dashboard</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">Track Order</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">Order Tracking Details</strong></div>
              </div>
            </div>
          </div>  

   <div class="site-section border-bottom" data-aos="fade">
     <div class="container">
       <div class="row mb-3 p-2">
  
           <div class="site-section-heading pt-3">
           <h2 class="text-black">Order Details</h2>
           <div style="display:flex">
           <p class="pr-3">Order ID: #{{$track_order->invoice_number}} </p>
           @if($track_order->status == 'pending')
            <p class="badge badge-pill badge-warning pr-5 pl-5" style="text-align: center; color:white;"> {{ $track_order->status }}</p>
            @elseif($track_order->status == 'confirm')
            <p class="badge badge-pill badge-info pr-5 pl-5" style="text-align: center; color:white;"> {{ $track_order->status }} </p>
            @elseif($track_order->status == 'processing')
            <p class="badge badge-pill badge-danger pr-5 pl-5" style="text-align: center; color:white;"> {{ $track_order->status }} </p>
            @elseif($track_order->status == 'delivered')
            <p class="badge badge-pill badge-success pr-5 pl-5" style="text-align: center; color:white;"> {{ $track_order->status }} </p>
            @elseif($track_order->status == 'cancelled')
            <p class="badge badge-pill badge-secondary pr-5 pl-5" style="text-align: center; color:white;"> {{ $track_order->status }} </p>
            @endif
           </div>
           </div>
       </div>
        <div class="row mb-5">
       {{-- <div class="col-lg-4">
        @include('frontend.dashboard.dashboard_sidebar')
           
       </div> --}}
              
       <div class="col-lg-12">
        <div class="container">
            <article class="card">
               
                <div class="card-body">
                    <h6>Order ID: {{$track_order->invoice_number}}</h6>
                    <article class="card">
                        <div class="card-body row">
                            <div class="col"> <strong>Order Date:</strong> <br><i class="fa fa-calendar trackIcon"></i> {{$track_order->order_date}}</div>
                            <div class="col"> <strong>Shipping For:</strong> <br><i class="fa fa-globe trackIcon"></i> {{$track_order['country']['country_name']}}, {{$track_order->city_name}}<br><i class="fa fa-home trackIcon"></i> {{$track_order->address}} </div>
                            <div class="col"> <strong>Customer info:</strong> <br> <i class="fa fa-envelope trackIcon"></i> {{$track_order->email}}<br><i class="fa fa-phone trackIcon"></i> {{$track_order->phone}} </div>
                            <div class="col"> <strong>Payment:</strong> <br><i class="fa fa-credit-card-alt trackIcon"></i> {{$track_order->payment_method}}</div>
                            <div class="col"> <strong>Amount:</strong> <br> <i class="fa fa-usd trackIcon"></i> {{$track_order->amount}} BHD</div>
                        </div>
                    </article>
                    <div class="track">

                        @if($track_order->status == 'pending')
                        <div class="step active"> <span class="icon"> <i class="fa fa-hourglass-end"></i> </span> <span class="text">Order pending <br> <span style="color: gray; font-size:12px;">12/34/2029</span></span></div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order confirmed</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-gear"></i> </span> <span class="text">Order processing</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order delivered</span> </div>

                        @elseif($track_order->status == 'confirmed')
                        <div class="step active"> <span class="icon"> <i class="fa fa-hourglass-end"></i> </span> <span class="text">Order pending <br> <span style="color: gray; font-size:14px;">{{$track_order->order_date}}</span></span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order confirmed <br> <span style="color: gray; font-size:14px;">{{$track_order->confimed_date}}</span></span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-gear"></i> </span> <span class="text">Order processing</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order delivered</span> </div>
                        @elseif($track_order->status == 'processing')
                        <div class="step active"> <span class="icon"> <i class="fa fa-hourglass-end"></i> </span> <span class="text">Order pending <br> <span style="color: gray; font-size:14px;">{{$track_order->order_date}}</span></span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order confirmed <br> <span style="color: gray; font-size:14px;">{{$track_order->confimed_date}}</span></span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-gear"></i> </span> <span class="text">Order processing  <br> <span style="color: gray; font-size:14px;">{{$track_order->processing_date}}</span></span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order delivered</span> </div>
                        @elseif($track_order->status == 'delivered')
                        <div class="step active"> <span class="icon"> <i class="fa fa-hourglass-end"></i> </span> <span class="text">Order pending <br> <span style="color: gray; font-size:14px;">{{$track_order->order_date}}</span></span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order confirmed <br> <span style="color: gray; font-size:14px;">{{$track_order->confimed_date}}</span></span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-gear"></i> </span> <span class="text">Order processing <br> <span style="color: gray; font-size:14px;">{{$track_order->processing_date}}</span></span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order delivered <br> <span style="color: gray; font-size:14px;">{{$track_order->delivery_date}}</span></span> </div>
                        @else
                        @endif
                    </div>

                    
                    
                    <br><br>
                    <a href="{{route('user.orders.page')}}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> View Orders</a>
                </div>
            </article>
        </div>
       </div>
   </div>
   @endsection