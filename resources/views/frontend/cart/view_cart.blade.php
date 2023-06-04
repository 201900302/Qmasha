@extends('frontend.master_dashboard')
@section('main')


<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">

        <div class="site-section-heading pt-3 mb-4">
            <h2 class="text-black">My Cart</h2>
            <p>There Are <span class="badge rounded-pill bg-secondary text-light" id="cartQtyTwo"></span> Products in Your Cart</p>
            </div>


      <div class="row mb-5">
        
          <div class="site-blocks-table">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="product-thumbnail">Image</th>
                  <th class="product-name">Product</th>
                  <th class="product-price">Price</th>
                  <th>Color</th>
                  <th>Size</th>
                  <th class="product-quantity">Quantity</th>
                  <th class="product-total">Subtotal</th>
                  <th class="product-remove">Remove</th>
                </tr>
              </thead>
              <tbody id="ViewCartProducts">
                
              </tbody>
            </table>
          </div>
        
      </div>

      <div class="row">
        <div class="col-md-6">
            @if (Session::has('coupon'))
           

            @else
            <form action="#">
            <div class="row" id="couponField">
              
              <div class="col-md-12">
                <label class="text-black h4" for="coupon">Coupon</label>
                <p>Enter your coupon code if you have one.</p>
              </div>
              
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="coupon_code" placeholder="Coupon Code">
              </div>
              <div class="col-md-4">
                <a type="submit" onclick="applyCoupon()" class="btn btn-primary btn-sm text-light">Apply Coupon</a>
              </div>
              
            </div>
          </form>
            @endif
          
        </div>

        <div class="col-md-6 pl-5">
          <div class="row justify-content-end">
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                  <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                </div>
              </div>

              <div id="couponCalcField">
              </div>

              <div class="row">
                <div class="col-md-12">
                  <a href="{{route('checkout')}}" class="btn btn-primary btn-lg py-3 btn-block text-light">Proceed To Checkout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection