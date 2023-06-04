@extends('frontend.master_dashboard')
@section('main')
<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">Payment</strong></div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
 
      <div class="row">

        <div class="col-md-8">

          <div class="row mb-5">
            <div class="col-md-12">
              <h2 class="h3 mb-3 text-black">Cash Payment</h2>
              <div class="p-3 p-lg-5 border">
                

               
                <form role="form" method="POST" action="{{ route('cash.order') }}">
                    @csrf

                    {{-- order details --}}
                    <input type="hidden" name="customer_name" value="{{$data['customer_name']}}">
                    <input type="hidden" name="email" value="{{$data['customer_email']}}">
                    <input type="hidden" name="phone" value="{{$data['customer_phone']}}">
                    <input type="hidden" name="country_id" value="{{$data['country_id']}}">
                    <input type="hidden" name="city_name" value="{{$data['city_name']}}">
                    <input type="hidden" name="address" value="{{$data['customer_address']}}">
                    <input type="hidden" name="postal_code" value="{{$data['customer_postal_zip']}}">
                    <input type="hidden" name="order_note" value="{{$data['customer_order_notes']}}">
                    <input type="hidden" name="amount" value="{{session()->get('order')['amount']}}">

                    <button class="subscribe btn btn-primary btn-block" type="submit"> Confirm </button>
                </form>
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-4">
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order Details</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                   
                    <tbody>
                      
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Cart Total</strong></td>
                        <td class="text-black">{{$cartTotalAmount}} BHD</td>
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
                          <td class="text-black" id="shipCost">{{$shippingCost}} BHD</td>
                      </tr>

                      <tr id="codField">
                        <td class="text-black font-weight-bold"><strong>Cash On Delivery Charge</strong></td>
                        <td class="text-black" id="cashOnDeliveryCharge">4 BHD</td>
                    </tr>
  
                      
                      <tr>
                          <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                          <td class="text-black font-weight-bold"><strong name="orderTotalCoupon" id="orderTotalWithCoupon">{{$orderTotalAmount}}</strong> BHD</td>
                        </tr>
                      
                      
                    </tbody>
                  </table>
  
                 
                  
  
                  <div class="form-group">
                    <H4 class="text-center">Pay {{round($orderTotalAmount, 2)}} BHD</H4>
                  </div>
  
                </div>
              </div>
            </div>
  
          
        </div>

      </div>
    </div>
  </div>
@endsection