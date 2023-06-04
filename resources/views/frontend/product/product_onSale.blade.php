@extends('frontend.master_dashboard')
@section('main')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a><span class="mx-2 mb-0">/</span> <strong class="text-black">All On Sale Products </strong></div>
      </div>
    </div>
  </div>
    
    
  
  <div class="site-section">
    <div class="container">

      <div class="row mb-5">
        <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="h5 text-black">All On Sale Products Results <span class="badge rounded-pill bg-secondary text-light">{{ count($products) }}</span></h2><hr></div>
                {{-- {{ count($boutique_products) }} --}}
              </div>
            </div>



        <div class="row mb-5">

            
@foreach ($products as $product)
              <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                
                <div class="block-4 text-center border">
                    @if ($product->discount_price != null || $product->discount_price > 0) 
    
                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price)*100;
    
                    @endphp
    
    
                    <div class="product-badges product-badges-position product-badges-mrg ml-3">
                    <span class="hot">{{round($discount)}} %</span>
                    </div>
                    @endif
                    <figure class="block-4-image">
                      <img src="{{url($product->product_thumbnail)}}" alt="Image placeholder" class="img-fluid">
                    </figure>
                    <div class="block-4-text p-4">
                      <h5><a class="text-black" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{$product->product_name}}</a></h5>
                      <p class="mb-0"><i class="fa fa-shop"></i> By <a href="{{route('boutique.details', $product->vendor_id)}}"> {{$product['vendor']['boutiqueName']}}</a></p>                  
                      <p class="text-primary font-weight-bold colored-p">
                        
                        @if ($product->discount_price != null || $product->discount_price > 0) 
                        <span class="old-price">{{$product->selling_price}} BHD</span>
                          {{$product->discount_price}} BHD
                        
                        @else
                          {{$product->selling_price}} BHD
                        
                        @endif
                      
                      </p>
                      <a type="button" class="btn btn-sm" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">Add <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                      <a id="{{$product->id}}" onclick="addToWishlist(this.id)" aria-label="Add To Wishlist" class="btn btn-sm favProductBtn"><i class="fa fa-heart" aria-hidden="true"></i></a>

                    </div>


                </div>

                
              
              
              
            </div>
            @endforeach
        



        </div>
            
          </div>

        <div class="col-md-3 order-1 mb-5 mb-md-0">
          <div class="border p-4 rounded mb-4">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
            <ul class="list-unstyled mb-0">
                @foreach($categories as $category)

                @php
                $products = App\Models\Product::where('category_id', $category->id)->where('status', 1)->get();
                @endphp
                    <li class="mb-1"><a href="{{url('product/category/'.$category->id.'/'.$category->category_slug)}}" class="d-flex"><span>{{$category->category_name}}</span><span class="text-black ml-auto">({{count($products)}}) 
                        @if (count($products) <= 1 )
                        <span class="text-black ml-auto"> item</span>
                        @else 
                        <span class="text-black ml-auto"> items</span>
                        @endif 
                    </a></li>
                @endforeach  
            </ul>
          </div>

          <div class="border p-4 rounded mb-4">

            <form action="{{route('shop.sale.filter')}}" method="POST">
              @csrf
  
  
  
              @if (!empty($_GET['category']))
  
              @php
              $filterCat = explode(',', $_GET['category']);
              @endphp
                  
              @endif
  
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter By Category</h3>
                @foreach ($categories as $category)
  
                @php
                $products = App\Models\Product::where('category_id', $category->id)->where('status', 1)->where('on_sale', 1)->get();
                @endphp
                    <label class="d-flex" for="checkbox{{$category->id}}">
                      <input type="checkbox" name="category[]" value="{{$category->category_slug}}" id="checkbox{{$category->id}}" class="mr-2 mt-1" @if(!empty($filterCat) && in_array($category->category_slug, $filterCat)) checked @endif onchange="this.form.submit()"/> <span class="text-black">{{$category->category_name}} ({{count($products)}})</span>
                    </label>
                @endforeach
              </div>
  
  
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
  
  
                <div id="slider-range" class="price-filter-range" name="rangeInput" data-min="0" data-max="300"></div>
  
                <input type="hidden" id="price_range" name="price_range" value="">
                <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" value="0BHD - 300BHD" readonly="" />
  
                  
                  <button type="submit" class="btn btn-sm btn-defualt" id="price-range-submit"><i class="fa fa-filter"></i> Apply Filter</button>
  
              </div>
  
            </form>
          </div>

        </div>
      

      
    </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){

    if($('#slider-range').length > 0){
      const max_price = parseInt($('#slider-range').data('max'));
      const min_price = parseInt($('#slider-range').data('min'));
      let price_range = min_price+"-"+max_price;

      let price = price_range.split('-');

      $("#slider-range").slider({
      range: true,
      min: min_price,
      max: max_price,
      values: price,
      step: 5,

      slide: function (event, ui) {
        
        
        
        $("#amount").val(ui.values[0]+" BHD - "+ui.values[1]+" BHD");
        $("#price_range").val(ui.values[0]+"-"+ui.values[1]);
      }
    });
    }
  });
  </script>

@endsection