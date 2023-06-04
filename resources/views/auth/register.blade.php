<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Register</title>
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
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">User Register</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
          <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
              <h2>User Register Page</h2>
              <p style="font-size: 16px">Have an account? <a href="{{route('login')}}">login</a></p>
          </div>
          </div><!-- comment -->
          
          
          <div class="row">
              
               
        <div class="mx-auto col-10 col-md-8 col-lg-6">
          <!-- Form -->
          
          <form method="POST" action="{{ route('register') }}">
            @csrf
             
            <!-- Input fields -->

            <!-- Email Address -->
        


            <div class="p-3 p-lg-5 border">

               
                <div class="form-group">
                    <label for="email" class="text-black" for="name">User Name </label>
                    <input type="text" class="form-control" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"> 
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
               
          
                <div class="form-group">
                <label for="email" :value="__('Email')" class="text-black">Email </label>
                <input type="text" class="form-control" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="email"> 
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="form-group">

                <label for="phone" :value="__('Phone')" class="text-black">Phone Number</label><br>
                <input class="form-control" id="phone" name="phone" type="tel" :value="old('phone')">
                
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>



            <!-- Password -->
            <div class="form-group">

                <label for="password" :value="__('Password')" class="text-black">Password </label>
                <input  type="password" class="form-control" id="password" name="password" required autocomplete="new-password" >
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                
            </div>

            <div class="form-group">

                <label for="password_confirmation" :value="__('Confirm Password')" class="text-black">Confirm Password </label>
                <input  type="password" class="form-control" id="password_confirmation"  name="password_confirmation" required autocomplete="current-password" >
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

        













        
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
    
  {{-- <script>
    const phoneInputField = document.querySelector("#phone");

    const phoneInput = window.intlTelInput(phoneInputField, {
      utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });


    const info = document.querySelector(".alert-info");

function process(event) {
 event.preventDefault();

 const phoneNumber = phoneInput.getNumber();

 info.style.display = "";
 info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;

 document.getElementById("phoneSpan").innerHTML = ${phoneNumber};

 return $phoneNumber;
}

  </script> --}}
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


{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
