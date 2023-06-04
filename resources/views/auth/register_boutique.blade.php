<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Boutique Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="{{ asset('frontend/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">


    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    

    <link rel="stylesheet" href="{{asset('phone_number_input/css/intlTelInput.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  </head>
  <body>
  
  <div class="site-wrap">
    @include('frontend.body.header')


    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Boutique Register</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
          <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
              <h2>Boutique Register Page</h2>
              <p style="font-size: 16px">Have an account? <a href="{{route('vendor.login')}}">login</a></p>
          </div>
          </div><!-- comment -->
          
          
          <div class="row">
              
               
        <div class="mx-auto col-10 col-md-8 col-lg-6">
          <!-- Form -->
          
          <form method="POST" action="{{ route('vendor.register') }}" enctype="multipart/form-data">
            @csrf
             
            <!-- Input fields -->

            <!-- Email Address -->
        


            <div class="p-3 p-lg-5 border">

               <strong>Personal Information</strong><br><br>
                <div class="form-group">
                    <label for="name" class="text-black" for="name">User Name </label>
                    <input type="text" class="form-control" id="name" type="text" name="name" required autofocus autocomplete="name"> 
                </div>
                
               
          
                <div class="form-group">
                <label for="email" class="text-black">Email </label>
                <input type="email" class="form-control" id="email" name="email" required autofocus autocomplete="email"> 
            </div>

            <div class="form-group">

                <label for="phone" :value="__('Phone')" class="text-black">Phone Number</label><br>
                <input class="form-control" id="phone" name="phone" type="tel">
            </div>

            <div class="form-group">
                <label for="address" class="text-black">Address </label>
                <input type="text" class="form-control" id="address" name="address" required autofocus autocomplete="address"> 
            </div>


            <!-- Password -->
            <div class="form-group">
                <label for="password" class="text-black">Password </label>
                <input  type="password" class="form-control" id="password" name="password" required autocomplete="new-password" >
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="text-black">Confirm Password </label>
                <input  type="password" class="form-control" id="password_confirmation"  name="password_confirmation" required autocomplete="current-password" >
            </div>

            <br><br><strong>Boutique Information</strong><br><br>
            
                <div class="form-group">
                    <label for="boutiqueName" class="text-black" for="name">Boutique Name </label>
                    <input type="text" class="form-control" id="boutiqueName" type="text" name="boutiqueName" :value="old('boutiqueName')" required autofocus autocomplete="boutiqueName"> 
                </div>
                <div class="form-group">
                    <label for="vendor_description" class="text-black">Short Description About The Boutique </label>
                    <textarea type="text" class="form-control" id="vendor_description" type="text" name="vendor_description" :value="old('vendor_description')" required autofocus autocomplete="vendor_description"> </textarea>
                </div>


                <div class="form-group">
                    <label for="account_url" class="text-black">Your Bussniss Instagram account URL </label>
                    <input type="text" class="form-control" id="account_url" name="account_url" :value="old('account_url')" required autofocus autocomplete="account_url"> 
                </div>

                <div class="form-group">

                <label for="image" class="text-black">Your Boutique Logo </label>
                    
                        <input type="file" name="logo" class="form-control" id="image" />
                    
                </div>

                <div class="form-group">
                    <h6 class="mb-0"> </h6>
                    <div class="col-sm-9 text-secondary">
                        <img id="showImage" src="{{ url('uploud/no_image.svg') }}" alt="Admin" class="p-1" width="110">

                    </div>

                </div>









        
                 <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

           <br>
           
            
        </div>



            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Register">

            </div>
          </form>

          <div class="alert alert-info" style="display: none;"></div>
          <!-- Form end -->
        </div>
      </div>
           
         
      </div>
    </div>

    @include('frontend.body.footer')
  </div>

  <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('frontend/js/aos.js') }}"></script>

  <script src="{{ asset('frontend/js/main.js') }}"></script>


  <script src="{{asset('phone_number_input/js/intlTelInput.js')}}"></script>
  <script>
    // Vanilla Javascript
    var input = document.querySelector("#phone");
    window.intlTelInput(input,({
      // options here
    }));

    $(document).ready(function() {
        $('.iti__flag-container').click(function() { 
          var countryCode = $('.iti__selected-flag').attr('title');
          var countryCode = countryCode.replace(/[^0-9]/g,'')
          $('#phone').val("");
          $('#phone').val("+"+countryCode+" "+ $('#phone').val());
       });
    });
  </script>
    
    <script type="text/javascript">

        $(document).ready(function(){
        
            $('#image').change(function(e){
        
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(e.target.files['0']);
            })
        
        
        });
        
        </script>
  </body>
</html>



<script>

const input = document.querySelector("#phone");
const errorMsg = document.querySelector("#error-msg");
const validMsg = document.querySelector("#valid-msg");

// here, the index maps to the error code returned from getValidationError - see readme
const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// initialise plugin
const iti = window.intlTelInput(input, {
  utilsScript: "/intl-tel-input/js/utils.js?1681516311936"
});

const reset = () => {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
};

// on blur: validate
input.addEventListener('blur', () => {
  reset();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      validMsg.classList.remove("hide");
    } else {
      input.classList.add("error");
      const errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
    }
  }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);
</script>




