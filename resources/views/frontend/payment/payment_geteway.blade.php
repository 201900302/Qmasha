@extends('frontend.master_dashboard')
@section('main')

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0">
          <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> 
          <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> 
          <strong class="text-black">Checkout</strong><span class="mx-2 mb-0">/</span> 
          <strong class="text-black">Payment</strong><
          /div>
      </div>
    </div>
  </div>


<div class="site-section">
    <div class="container">
 
      <div class="row">

        <div class="col-md-8">

          <div class="row mb-5">
            <div class="col-md-12">
              <h2 class="h3 mb-3 text-black">Make Payment</h2>
              <div class="p-3 p-lg-5 border">
                

                @foreach (['danger', 'success'] as $status)
                @if(Session::has($status))
                    <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
                @endif
                @endforeach

                <form role="form" method="POST" id="payment-form" action="{{ route('stripe.order') }}">
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

                    <div class="form-group">
                        <label for="username">Full name (on the card)</label>
                        <input type="text" class="form-control" name="fullName" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="cardNumber">Card number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="cardNumber" placeholder="Card Number">
                            <div class="input-group-append">
                                <span class="input-group-text text-muted">
                                <i class="fab fa-cc-visa fa-lg pr-1"></i>
                                <i class="fab fa-cc-amex fa-lg pr-1"></i>
                                <i class="fab fa-cc-mastercard fa-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label><span class="hidden-xs">Expiration</span> </label>
                                <div class="input-group">
                                    <select class="form-control" name="month">
                                        <option value="">MM</option>
                                        @foreach(range(1, 12) as $month)
                                            <option value="{{$month}}">{{$month}}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control" name="year">
                                        <option value="">YYYY</option>
                                        @foreach(range(date('Y'), date('Y') + 10) as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label data-toggle="tooltip" title=""
                                    data-original-title="3 digits code on back side of the card">CVV <i
                                    class="fa fa-question-circle"></i></label>
                                <input type="number" class="form-control" placeholder="CVV" name="cvv">
                            </div>
                        </div>
                    </div>
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
                    {{-- <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead> --}}
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


















{{-- 
<script type="text/javascript">
    // Create a Stripe client.
var stripe = Stripe('pk_test_51N7qEsCgClfePXf5MqTdo14PYLkXstj5pbyDJ9b5fqwyoUOXnvOdfIuw3FsM7twVAdI4Z9LzcsBOi1RrhMLFzDaM00RCAcPnnG');
// Create an instance of Elements.
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};
// Create an instance of the card Element.
var card = elements.create('card', {style: style});
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});
// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  // Submit the form
  form.submit();
}
</script> --}}

@endsection