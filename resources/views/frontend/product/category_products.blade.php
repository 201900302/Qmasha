@extends('frontend.master_dashboard')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$categoryName->category_name}}</strong></div>
      </div>
    </div>
  </div>
    
    
     
  <div class="boutiqueSection py-3" >
         
    <div class="container" >
        <div class="boutiqueInfo">
            
            
          <div style="margin-top: -50px;"><img style="height: 200px; width: 200px; box-shadow: 10px 10px 5px #ccc;" src="{{url($categoryName->category_image)}}" class="rounded" alt="" ></div>
          <div class="boutiqueTextInfo pl-4">
            
              <h3 class="pt-5" style="color: #926F34">{{$categoryName->category_name}} Collection</h3>
              
          </div>
      
    </div>
    </div><!-- comment -->
    </div>
    
    

  <div class="site-section">
    <div class="container">

      <div class="row mb-5">
        <div class="col-md-9 order-2">

          <div class="row">
            <div class="col-md-12 mb-5">
              <div class="float-md-left mb-4"><h2 class="h5 text-black">All {{$categoryName->category_name}} Products Results <span class="badge rounded-pill bg-secondary text-light">{{ count($products) }}</span></h2><hr></div>
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
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Shop By Category</h3>
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
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Subcategory</h3>
              <ul class="list-unstyled mb-0">
                  @foreach($subcategories as $subcategory)
  
                  @php
                  $products = App\Models\Product::where('subcategory_id', $subcategory->id)->where('status', 1)->get();
                  @endphp
                      <li class="mb-1"><a href="{{url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug)}}" class="d-flex"><span>{{$subcategory->subcategory_name}}</span><span class="text-black ml-auto">({{count($products)}}) 
                          @if (count($products) <= 1 )
                          <span class="text-black ml-auto"> item</span>
                          @else 
                          <span class="text-black ml-auto"> items</span>
                          @endif 
                      </a></li>
                  @endforeach  
              </ul>
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