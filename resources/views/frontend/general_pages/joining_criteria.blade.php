@extends('frontend.master_dashboard')
@section('main')

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Boutiques Joining Criteria</strong></div>
      </div>
    </div>
  </div>  

  <div class="site-section border-bottom" data-aos="fade">
    <div class="container">
      <div class="row mb-5 p-2">
        
        
       
          
          
          <div class="site-section-heading pt-3 mb-4">
          <h2 class="text-black">Our Boutiques Joining Criteria</h2>
          </div>
          <p>Are you a designer? <br>Need to improve your sales and expand your selling range? <br>Qmasha is your perfect destination. We provide you with unlimited selling and advertisement powers. If you are clothing designer for “Abayas, dresses, tops or any women`s wearing sets”, you are welcome to start your journey with us by creating your boutique in Qmasha website. We will take the responsibility of the advertising, promoting, and selling your products, including the payment and delivery process. Beginning from now, your first responsibility is your designs! Any other business responsibility ,is ours!<br><br><a href="{{ route('register.boutique') }}">Register</a> your boutique application now, and we will reach you as soon as possible with your application results. </p>              
        {{-- <p><a href="{{ route('register.boutique') }}">Register</a></p> --}}
        
      </div>
    </div>
  </div>
  
@endsection