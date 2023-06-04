@extends('frontend.master_dashboard')
@section('main')

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Payment Methods</strong></div>
      </div>
    </div>
  </div>  

  <div class="site-section border-bottom" data-aos="fade">
    <div class="container">
      <div class="row mb-5 p-2">

          <div class="site-section-heading pt-3 mb-4">
          <h2 class="text-black">Our Payment Methods</h2>
          </div>
          <p><strong>Cash on Delivery</strong><br>For customers without access to a credit card, we accept Cash on Delivery (COD) as an alternative payment method for orders. Please note that since the COD service is costly for us to provide, cash payment orders will be charged additionally per order no matter the number of items your order contains. </p>
          <p><strong>Stripe Payment Gateway</strong><br>At Qmasha, our preferred payment method is via a secure credit card transaction. Rest assured, your card number will be protected using industry-leading encryption standards. We guarantee a safe shopping experience on our website. Orders completed with credit cards will not be charged any additional fees.</p>

        
      </div>
    </div>
  </div>

  
@endsection