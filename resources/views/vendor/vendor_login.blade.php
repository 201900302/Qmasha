@extends('frontend.master_dashboard')
@section('main')
  
  
   
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Vendor Login</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
          <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
              <h2>Vendor Login Page</h2><br>
          </div>
          </div><!-- comment -->
          
          
          <div class="row">
              
               
        <div class="mx-auto col-10 col-md-8 col-lg-6">
          <!-- Form -->
          
          <form method="POST" action="{{ route('login') }}">
            @csrf
             
            <!-- Input fields -->

            <!-- Email Address -->
        


            <div class="p-3 p-lg-5 border">

            <div class="form-group">
                <label for="c_fname" class="text-black">Email <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="email" type="email" name="email" required autofocus > 
               
            </div>

            <div class="form-group">

                <label for="password" class="text-black">Password<span class="text-danger">*</span></label>
                <input  type="password" class="form-control" id="password" name="password" required >
                
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />


                 <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

           <br>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}<br><br>
                </a>
            @endif
            
        </div>

        
            

            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login">

            </div>
          </form>
          <!-- Form end -->
        </div>
      </div>
           
         
      </div>
    </div>



  @endsection
{{-- 
  <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('frontend/js/aos.js') }}"></script>

  <script src="{{ asset('frontend/js/main.js') }}"></script>


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
     @if(Session::has('message'))
     var type = "{{ Session::get('alert-type','info') }}"
     switch(type){
      case 'info':
      toastr.info(" {{ Session::get('message') }} ");
      break;
    
      case 'success':
      toastr.success(" {{ Session::get('message') }} ");
      break;
    
      case 'warning':
      toastr.warning(" {{ Session::get('message') }} ");
      break;
    
      case 'error':
      toastr.error(" {{ Session::get('message') }} ");
      break; 
     }
     @endif 
    </script>
    
  </body>
</html>
 --}}
