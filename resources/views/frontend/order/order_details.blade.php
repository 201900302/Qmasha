@extends('dashboard')
@section('user')

    <div id="main">


        <div class="bg-light py-3">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">User Dashboard</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">My Orders</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">Order Details</strong></div>
              </div>
            </div>
          </div>  

   <div class="site-section border-bottom" data-aos="fade">
     <div class="container">
       <div class="row mb-3 p-2">
  
           <div class="site-section-heading pt-3">
           <h2 class="text-black">Order Details</h2>
           <div style="display:flex">
           <p class="pr-3">Order ID: #{{$order->invoice_number}} </p>
           @if($order->status == 'pending')
            <p class="badge badge-pill badge-warning pr-5 pl-5" style="text-align: center; color:white;"> {{ $order->status }}</p>
            @elseif($order->status == 'confirm')
            <p class="badge badge-pill badge-info pr-5 pl-5" style="text-align: center; color:white;"> {{ $order->status }} </p>
            @elseif($order->status == 'processing')
            <p class="badge badge-pill badge-danger pr-5 pl-5" style="text-align: center; color:white;"> {{ $order->status }} </p>
            @elseif($order->status == 'delivered')
            <p class="badge badge-pill badge-success pr-5 pl-5" style="text-align: center; color:white;"> {{ $order->status }} </p>
            @elseif($order->status == 'cancelled')
            <p class="badge badge-pill badge-secondary pr-5 pl-5" style="text-align: center; color:white;"> {{ $order->status }} </p>
            @endif
           </div>
           </div>
       </div>
        <div class="row mb-5">
       {{-- <div class="col-lg-4">
        @include('frontend.dashboard.dashboard_sidebar')
           
       </div> --}}
              
       <div class="col-lg-12">
           <div class="tab-content">
                   <div class="accordion">
                       <div class="card">
                           <div class="card">
                                           <div class="card-header">
                                               <h3 class="mb-0">Order Items</h3>
                                           </div>
                                           <div class="card-body">
                                               <div class="table-responsive">
                                                   <table class="table">
                                                       <thead>
                                                           <tr>
                                                               <th>Sl</th>
                                                               <th>Boutique</th>
                                                               <th>Product Name</th>
                                                               <th>Image</th>
                                                               <th>Price</th>
                                                               <th>Color</th>
                                                               <th>Size</th>
                                                               <th>Quantity</th>
    
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                        @foreach ($orderItems as $key => $orderItem)
                                                            
                                                        
                                                           <tr>
                                                               <td>{{$key+1}}</td>
                                                               <td><a href="{{route('boutique.details', $orderItem->vendor_id)}}"> {{$orderItem['vendor']['boutiqueName']}}</a></td>
                                                               <td><a href="{{ url('product/details/'.$orderItem->product_id.'/'.$orderItem['product']['product_slug']) }}"> {{$orderItem['product']['product_name']}}</a></td>
                                                               <td><img src="{{ url($orderItem['product']['product_thumbnail'])}}" style="height: 50px; width:50px;"></td>
                                                               <td>{{$orderItem->price}} BHD</td>
                                                               <td>{{$orderItem->color}}</td>
                                                               <td>
                                                                {{$orderItem->size}} 
                                                                @if ($orderItem->length == null)
                                                                 @else
                                                                 / length: {{$orderItem->length}}    
                                                                @endif
                                                                </td>
                                                                <td>{{$orderItem->qty}}</td>
                                                               {{-- <td>
                                                                @if($orderItem->status == 'pending')
                                                                <p class="badge badge-pill badge-warning" style="text-align: center; color:white;"> {{ $order->status }} </p>
                                                                @elseif($orderItems->status == 'confirm')
                                                                <p class="badge badge-pill badge-info" style="text-align: center; color:white;"> {{ $order->status }} </p>
                                                                @elseif($orderItems->status == 'processing')
                                                                <p class="badge badge-pill badge-danger" style="text-align: center; color:white;"> {{ $order->status }} </p>
                                                                @elseif($orderItems->status == 'delivered')
                                                                <p class="badge badge-pill badge-success" style="text-align: center; color:white;"> {{ $order->status }} </p>
                                                                @elseif($orderItems->status == 'cancelled')
                                                                <p class="badge badge-pill badge-secondary" style="text-align: center; color:white;"> {{ $order->status }} </p>
                                                                @endif
                                                                </td> --}}
                                                                {{-- <td>
                                                                <a href="{{ url('user/order-details/'.$orderItems->id) }}" class="btn-sm btn-primary">View</a>  
                                                                <a href="#" class="btn-sm btn-secondary"><i class="fa fa-download"></i></a> 
                                                                </td> --}}
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

   <div class="row mb-5">


    <div class="col-lg-4">
        <div class="tab-content">
            <div class="accordion">
        <div class="card">
            <div class="card-header" style="background-color: #DFBD69; color:white;">
                <h3 class="mb-0">Order Information</h3>
            </div>
        </div>
        <div class="card-body">
            <p><strong>Invoice No:</strong> {{$order->invoice_number}}</p>
            <p><strong>Amount:</strong> {{$order->amount}} BHD</p>
            <p><strong>Payment:</strong> {{$order->payment_method}}</p>
            <p><strong>Date:</strong> {{$order->order_date}}</p>
            <p><strong>Status:</strong> {{$order->status}}</p>
            <p><strong>Notes:</strong> {{$order->order_note}}</p>
        </div>
        </div>     
    </div> 
    </div>


    <div class="col-lg-4">
        <div class="tab-content">
            <div class="accordion">
        <div class="card">
            <div class="card-header"style="background-color: #DFBD69; color:white;">
                <h3 class="mb-0">Shipping Information</h3>
            </div>
        </div>
        <div class="card-body">
            <p><strong>To:</strong> {{$order['country']['country_name']}}, {{$order->city_name}}</p>
            <p><strong>Address:</strong> {{$order->address}}</p>
            <p><strong>Postal Code:</strong> {{$order->postal_code}}</p>
            
        </div>
        </div>
    </div>
    </div>

        <div class="col-lg-4">
            <div class="tab-content">
                <div class="accordion">
            <div class="card">
                <div class="card-header"style="background-color: #DFBD69; color:white;">
                    <h3 class="mb-0">Customer Information</h3>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{$order->name}}</p>
                <p><strong>Email:</strong> {{$order->email}}</p>
                <p><strong>Phone No:</strong> {{$order->phone}}</p>
               
            </div>
            </div>
        </div>
        </div>
   </div>

   @endsection