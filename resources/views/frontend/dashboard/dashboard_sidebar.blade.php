@php
// take the route name od the running page
$route = Route::current()->getName();
@endphp
<style>
    .nav .nav-link:hover{
        background-color: #DFBD69;
    }
</style>

<div class="nav nav-pills faq-nav">

    <a href="{{route('dashboard')}}" class="nav-link {{ ($route == 'dashboard')? 'active':'' }} ">
      Dashboard
    </a>

    <a href="{{route('user.orders.page')}}" class="nav-link {{ ($route == 'user.orders.page')? 'active':'' }}" >
        <span class="icon-shopping-bag"></span> My Orders
    </a>

    <a href="{{route('user.track.order')}}" class="nav-link {{ ($route == 'user.track.order')? 'active':'' }}" >
        <span class="icon-truck"></span> Track an Order
    </a>

    <a href="{{route('user.account.page')}}" class="nav-link {{ ($route == 'user.account.page')? 'active':'' }}">
        <span class="icon-account_circle"></span> Account Details
        
    </a><!-- comment -->

    <a  href="{{route('user.change.password')}}" class="nav-link {{ ($route == 'user.change.password')? 'active':'' }}" >
     <span class="icon-key"></span> Change Password
     
 </a>

    <a href="{{ route('user.logout') }}" class="nav-link">
     Logout
    </a>
    
</div>