@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Manage Orders</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Order Details</li>
							</ol>
						</nav>
                        
					</div>
					{{-- <div class="ms-auto">
						<div class="btn-group">
		                    <a href="{{ route('add.category') }}" class="btn btn-primary">Confirm Order</a> 				 
		 				 
						</div>
					</div> --}}
				</div>
				<!--end breadcrumb-->
				<hr/>
				




                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                
  
                    <div class="site-section-heading pt-3">
                    
                    <p class="pr-3">Order ID: #{{$order->invoice_number}} </p>
                    <p class="pr-3">Order Status: {{$order->status}} </p>
                    
                    </div>
                    <div class="ms-auto">
						<div class="btn-group">

                            @if($order->status == 'pending')
		                    <a href="{{ route('mark.confirm.order', $order->id) }}" class="btn btn-success" id="confirm">Confirm Order</a> 				 
                            @elseif($order->status == 'confirmed')
                            <button disabled class="btn btn-secondary">Wait For Vendors To Start Process The Order</button>
                            {{-- <a href="{{ route('mark.process.order', $order->id) }}" class="btn btn-success" id="process">Process Order</a>  --}}
                            @elseif($order->status == 'processing')
                            <a href="{{ route('mark.deliver.order', $order->id) }}" class="btn btn-success" id="deliver">Deliver Order</a>	
                            @else
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
                                                                            <th>Status</th>
                 
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
                                                                            <td>
                                                                             @if($orderItem->status == 'pending')
                                                                             <p class="budge rounded-pill bg-warning" style="text-align: center; color:white;"> {{ $orderItem->status }} </p>
                                                                             @elseif($orderItem->status == 'processing')
                                                                             <p class="budge rounded-pill bg-primary" style="text-align: center; color:white;"> {{ $orderItem->status }} </p>
                                                                             @elseif($orderItem->status == 'ready')
                                                                             <p class="budge rounded-pill bg-danger" style="text-align: center; color:white;"> {{ $orderItem->status }} </p>
                                                                             @elseif($orderItem->status == 'delivered')
                                                                             <p class="budge rounded-pill bg-success" style="text-align: center; color:white;"> collected </p>
                                                                             @elseif($orderItem->status == 'cancelled')
                                                                             <p class="budge rounded-pill bg-secondary" style="text-align: center; color:white;"> {{ $orderItem->status }} </p>
                                                                             @elseif($orderItem->status == 'reviewing')
                                                                             <p class="budge rounded-pill bg-secondary" style="text-align: center; color:white;"> {{ $orderItem->status }}.. </p>
                                                                             
                                                                             @endif
                                                                             </td>
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
             
                <div class="row mb-5">
             
             
                 <div class="col-lg-6">
                     <div class="tab-content">
                         <div class="accordion" style="background-color: white;">
                     <div class="card">
                         <div class="card-header" style="background-color: #ddd">
                             <h3 class="mb-0">Order Information</h3>
                         </div>
                     </div>
                     <div class="card-body">
                        
                         <p><strong>Invoice No:</strong> {{$order->invoice_number}}</p>
                         <p><strong>Amount:</strong> {{$order->amount}} BHD</p>
                         <p><strong>Payment:</strong> {{$order->payment_method}}</p>
                         <p><strong>transaction Id:</strong> {{$order->transaction_id}}</p>
                         <p><strong>Date:</strong> {{$order->order_date}}</p>
                         <p><strong>Status:</strong> {{$order->status}}</p>
                     </div>
                     </div>     
                 </div> 
                 </div>
             
             
                 <div class="col-lg-6">
                     <div class="tab-content">
                         <div class="accordion" style="background-color: white;">
                     <div class="card">
                         <div class="card-header"style="background-color: #ddd">
                             <h3 class="mb-0">Shipping Information</h3>
                         </div>
                     </div>
                     <div class="card-body">
                        <p><strong>Name:</strong> {{$order->name}}</p>
                             <p><strong>Email:</strong> {{$order->email}}</p>
                             <p><strong>Phone No:</strong> {{$order->phone}}</p>
                         <p><strong>To:</strong> {{$order['country']['country_name']}}, {{$order->city_name}}</p>
                         <p><strong>Address:</strong> {{$order->address}}</p>
                         <p><strong>Postal Code:</strong> {{$order->postal_code}}</p>
                         <p><strong>Notes:</strong> {{$order->order_note}}</p>
                         
                     </div>
                     </div>
                 </div>
                 </div>
             
                </div>





 
				 
			</div>
@endsection