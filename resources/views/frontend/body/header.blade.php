<header class="site-navbar" role="banner">
  <div class="site-section bg-light" style="padding-top: 10px; margin-bottom: 10px;">
    <div class="container">
    

      @auth

      <a style="float: right;" href="{{url('/user/logout')}}" >Logout</a> 

      @if(Auth::user()->role == 'user')
      <a style="float: right; margin-right: 30px;" href="{{url('/dashboard')}}" >Dashboard</a>
      @elseif(Auth::user()->role == 'vendor')
      <a style="float: right; margin-right: 30px;" href="{{url('/vendor/dashboard')}}" >Dashboard</a>
      @elseif(Auth::user()->role == 'admin')
      <a style="float: right; margin-right: 30px;" href="{{url('/admin/dashboard')}}" >Dashboard</a>  
      @endif
    {{-- <a style="float: right; margin-right: 30px;" href="#" >Log In</a>  --}}

      @else

      <a style="float: right;" href="{{url('/register')}}" >Sign In</a> 
      <a style="float: right; margin-right: 30px;" href="{{url('/login')}}" >Log In</a> 
      @endauth
    
    

   
    </div>
</div>

    <div class="site-navbar-top">
      <div class="container">
        <div class="row align-items-center">

          {{-- <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
            <form action="" class="site-block-top-search">
              <span class="icon icon-search2"></span>
              <input type="text" class="form-control border-0" placeholder="Search">
            </form>
          </div> --}}
          <div class="col-6 col-md-4 order-3 order-md-3 text-right">
            <div class="site-top-icons">
              <ul>
                
                <li class="has-children">
                  <a href="{{route('cart')}}" class="site-cart">
                  <span class="icon icon-shopping_cart"></span>
                  <span class="count" id="cartQty">0</span>
                  </a>
                  {{-- mini cart start whth ajax --}}
                  
                  <ul class="dropdown">

                    <div id="miniCart">
                    </div>
                    <li>
                      <div class="mini-cart-end" class="pl-2">
                      <div style="display: flex">
                      <h6 class="pt-1 pl-3">TOTAL</h6>
                      <div class="pr-2" style="margin-left: auto; margin-right: 0;">
                      <p id="cartSubTotal" style=""></p>
                      </div>
                      </div>
                      
                      <a href="{{route('cart')}}" type="button" class="btn primary-btn m-2"  style="height: 37px; font-size:16px; width: 96%; display:block; color:white"><p>View Cart</p></a>
                     
                    </div>
                    </li>             
                    
  
                                             
                  </ul>
                  
                </li>



                <li><a class="site-cart" href="{{route('wishlist')}}"><span class="icon icon-heart-o"></span><span class="count" id="wishlistQty">0</span></a></li>

                @auth
                @if(Auth::user()->role == 'user')
                <li><a href="{{url('/dashboard')}}" ><span class="icon icon-person"></span></a></li>
                @elseif(Auth::user()->role == 'vendor')
                <li><a  href="{{url('/vendor/dashboard')}}"><span class="icon icon-person"></span></a></li>
                @elseif(Auth::user()->role == 'admin')
                <li><a  href="{{url('/admin/dashboard')}}"><span class="icon icon-person"></span></a></li>
                @else
                @endif

                @else
                <li><a  href="{{url('/login')}}"><span class="icon icon-person"></span></a></li>
                @endauth
                
                


  
                <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
              </ul>
            </div> 
          </div>

          <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
            <div class="site-logo">
              <img src="{{ asset('images/logoTransparent.png') }}" alt="" class="img-fluid">
            </div>
          </div>

          
          <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
            <form action="{{route('product.search')}}" method="POST" class="site-block-top-search">
              @csrf
              <span class="icon icon-search2"></span>
              <input name="search" type="text" class="form-control border-0" placeholder="Search">
              <div id="searchProducts"></div>
            </form>
          </div>

        </div>
      </div>
    </div> 


@php
 $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();   
@endphp

    <nav class="site-navigation text-right text-md-center" role="navigation">
      <div class="container">
        <ul class="site-menu js-clone-nav d-none d-md-block">
            <li><a href="{{url('/')}}">Home</a></li>

            <li class="has-children">
              <a href="about.html">Qmasha</a>
              <ul class="dropdown">
                <li><a href="{{ route('show.about.page') }}">About Us</a></li>
                <li><a href="{{ route('show.joiningcriteria.page') }}">Join Us</a></li>
              </ul>
            </li>
          

          <li class="has-children">
            <a href="{{route('collection.all')}}">Collections</a>
            <ul class="dropdown">
              @foreach ($categories as $item)
              <li><a href="{{url('product/category/'.$item->id.'/'.$item->category_slug)}}">{{$item->category_name}}</a></li>
              @endforeach
            </ul>
          </li>

@php
$categories = App\Models\Category::orderBy('category_name', 'ASC')->limit(4)->get();
@endphp

@foreach ($categories as $category)            

          <li class="has-children">
            <a href="{{url('product/category/'.$category->id.'/'.$category->category_slug)}}">{{$category->category_name}}</a>
            

@php
$subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name', 'ASC')->get();  
@endphp
<ul class="dropdown">



@foreach ($subcategories as $subcategory)
    

              <li><a href="{{url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug)}}">{{$subcategory->subcategory_name}}</a></li>
@endforeach

            </ul>
          </li>
@endforeach

          <li><a href="{{route('boutique.all')}}">Boutiques</a></li>
          
          
          <li><a href="{{route('product.all')}}">Shop Now</a></li>
          <li><a href="{{route('product.sale.all')}}">On Sale</a></li>
          
          
          {{-- <li><a href="contact.html">Contact</a></li> --}}
        </ul>
      </div>
    </nav>
  </header>