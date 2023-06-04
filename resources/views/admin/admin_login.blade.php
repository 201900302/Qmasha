@extends('frontend.master_dashboard')
@section('main')
  
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Admin Login</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
          <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
              <h2>Admin Login Page</h2><br>
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
                <input type="text" class="form-control" id="email" type="email" name="email" required> 
               
            </div>

            <div class="form-group">

                <label for="password" class="text-black">Password<span class="text-danger">*</span></label>
                <input  type="password" class="form-control" id="password" name="password" required  >
                
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
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
