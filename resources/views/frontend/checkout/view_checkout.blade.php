@extends('frontend.master_dashboard')
@section('main')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0">
          <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> 
          <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> 
          <strong class="text-black">Checkout</strong>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <form method="POST" action="{{ route('store.checkout') }}">
        @csrf
      <div class="row">
        <div class="col-md-6 mb-5 mb-md-0">
          <h2 class="h3 mb-3 text-black">Billing Details</h2>
          <div class="p-3 p-lg-5 border">

            <div class="form-group row">
                <div class="col-md-12">
                  <label for="customer_name" class="text-black">Full Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{Auth::user()->name}}">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-md-12">
                  <label for="customer_email" class="text-black">Email<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="customer_email" name="customer_email" value="{{Auth::user()->email}}">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                  <label for="customer_phone" class="text-black">Phone<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{Auth::user()->phone}}">
                </div>
            </div>

            <div class="form-group">
              <label for="country_id" class="text-black">Country <span class="text-danger">*</span></label>
              <select id="country_id" name="country_id" class="form-control">
                <option value="">Select a country</option> 
                @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{$country->country_name}}</option>   
                @endforeach   
                  
              </select>
            </div>
            


            <div class="form-group row">
              <div class="col-md-12">
                <label for="customer_address" class="text-black">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="customer_address" name="customer_address" value="{{Auth::user()->address}}">
              </div>
            </div>

           

            <div class="form-group row">
              <div class="col-md-6">
                <label for="city_name" class="text-black">City <span class="text-danger">*</span></label>
                <select id="city_name" name="city_name" class="form-control">
                    <option value="">Select a City</option> 
                    
                        <option value=""></option>   
                    
                      
                  </select>
              </div>
              <div class="col-md-6">
                <label for="customer_postal_zip" class="text-black">Postal / Zip Code<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="customer_postal_zip" name="customer_postal_zip">
              </div>
            </div>
            

            <div class="form-group">
              <label for="customer_order_notes" class="text-black">Order Notes</label>
              <textarea name="customer_order_notes" id="customer_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
            </div>

          </div>
        </div>

        <div class="col-md-6">


          <div class="row mb-5">
            <div class="col-md-12">
              <h2 class="h3 mb-3 text-black">Your Order</h2>
              <div class="p-3 p-lg-5 border">
                <table class="table site-block-order-table mb-5">
                  <thead>
                    <th>Product</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    @foreach ($carts as $item)
                        <tr>
                            <td>{{$item->name}}<strong class="mx-2">x</strong> {{$item->qty}}</td>
                            <td>{{$item->price*$item->qty}} BHD</td>
                        </tr>
                    @endforeach
                    
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Cart Total</strong></td>
                      <td class="text-black">{{$cartTotal}} BHD</td>
                    </tr>

                    @if (Session::has('coupon'))
                    <tr>
                        <td class="text-black font-weight-bold"><strong>Coupon</strong></td>
                        <td class="text-black">{{session()->get('coupon')['coupon_code']}}</td>
                    </tr>
                    <tr>
                        <td class="text-black font-weight-bold"><strong>Discount Amount</strong></td>
                        <td class="text-black">- {{session()->get('coupon')['coupon_discount']}} %</td>
                    </tr>
                    <tr>
                        <td class="text-black font-weight-bold"><strong>Cart Total After Discount</strong></td>
                        <td class="text-black">{{session()->get('coupon')['total_amount']}} BHD</td>
                    </tr>

                    @else
                    @endif
                    
                    <tr id="shipCharge">
                        <td class="text-black font-weight-bold"><strong>Delivery Charge</strong></td>
                        <td class="text-black" id="shipCost"></td>
                    </tr>

                    <tr id="codField">
                        <td class="text-black font-weight-bold"><strong>Cash On Delivery Charge</strong></td>
                        <td class="text-black" id="cashOnDeliveryCharge"></td>
                    </tr>

                    @if (Session::has('coupon'))
                    <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong name="orderTotalCoupon" id="orderTotalWithCoupon">Loading ..</strong> BHD</td>
                      </tr>
                    @else
                    <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong name="orderTotalNoCoupon" id="orderTotalWithoutCoupon">Loading ..</strong> BHD</td>
                      </tr>
                    @endif

                    
                  </tbody>
                </table>

               
                {{-- payment  --}}

                <div class="payment ml-30">
                    {{-- <h4><i class="fa fa-credit-card" aria-hidden="true"></i> Payment</h4> --}}
                    <div class="payment_option">
                        <div class="form-group">
                            <i class="fa fa-credit-card" aria-hidden="true"></i> <label for="payment_method" class="text-black">Payment Method <span class="text-danger">*</span></label>
                            <select id="payment_method" name="payment_method" class="form-control">
                              <option value="">Select a Payment Method</option>    
                              <option value="cashOnDelivery">Cash On Delivary</option>    
                              <option value="stripeGateway">Stripe</option>    
                              {{-- <option value="3">PayPal</option>    
                              <option value="4">Credit/Debit Cart</option>      --}}
                            </select>
                          </div>
                    </div>
                    
                </div>
                
                

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Place Order</button>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
      </form>
    </div>
  </div>



  <script type="text/javascript">

//   to load the cities names of the selected country

    $(document).ready(function(){
        $('#codField').hide();
        $('#shipCharge').hide();
      $('select[name="country_id"]').on('change', function(){
        var country_id = $(this).val();
        if(country_id){
          $.ajax({
            url: " {{url('/city/ajax') }}/"+country_id,
            type: "GET",
            dataType: "json", 
            success:function(data){
                $('#shipCharge').show();
              $('select[name="city_name"]').html('');
              var d = $('select[name="city_name"]').empty();


              
              $.each(data, function(key, value){
  
                $('select[name="city_name"]').append('<option value="'+value+'">' + value+'</option>');
  
              });
            },
          });
        } else{
          alert('danger');
        }
      });
    });


//   to load the delivary cost of the selected country
$(document).ready(function(){
      $('select[name="country_id"]').on('change', function(){
        var country_id = $(this).val();

        if(country_id){
          $.ajax({
            url: " {{url('/shipping-cost/ajax') }}/"+country_id,
            type: "GET",
            dataType: 'json',
         success:function(response){
           
              $('#shipCost').text(response.cost + " BHD");

              @if(Session::has('coupon'))
              $('#orderTotalWithCoupon').text( {{session()->get('coupon')['total_amount']}} + response.cost);
              @else
                $('#orderTotalWithoutCoupon').text( {{$cartTotal}} + response.cost );
            @endif 
            ////////////////////////////
            $(document).ready(function(){
      $('select[name="payment_method"]').on('change', function(){

        var selectedMethod = $(this).val();

        if(selectedMethod == "cashOnDelivery"){
            $('#codField').show();

            $('#cashOnDeliveryCharge').text(4+ " BHD");

            @if(Session::has('coupon'))
              $('#orderTotalWithCoupon').text({{session()->get('coupon')['total_amount']}} + 4 + response.cost);
              $totalAmount = {{session()->get('coupon')['total_amount']}}  + response.cost + 4;
              @else
                $('#orderTotalWithoutCoupon').text({{$cartTotal}} + response.cost + 4);
                $totalAmount = {{$cartTotal}} + response.cost + 4;
            @endif 
            
        }
        
        else{
            $('#cashOnDeliveryCharge').empty();
        
            $('#codField').hide();

            @if(Session::has('coupon'))
              $('#orderTotalWithCoupon').text({{session()->get('coupon')['total_amount']}} + response.cost);
              $totalAmount = {{session()->get('coupon')['total_amount']}} + response.cost ;
            @else
                $('#orderTotalWithoutCoupon').text({{$cartTotal}} + response.cost);
                $totalAmount = {{$cartTotal}} + response.cost ;
            @endif 
        }


        });
    });
    ///////////////////////////////////////
 
        },
          });
        }
        
        else{
          alert('danger');
        }


        });
    });


  </script>

@endsection