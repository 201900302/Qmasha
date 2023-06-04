@extends('frontend.master_dashboard')
@section('main')


<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>Search Product<span class="mx-2 mb-0">/</span> <strong class="text-black">{{$searched_item}}</strong></div>
      </div>
    </div>
  </div>
    
    
     
  {{-- <div class="boutiqueSection py-3" >
         
    <div class="container" >
        <div class="boutiqueInfo">
            
            
          <div class="boutiqueTextInfo pl-4">
            
              <h3 class="pt-3" style="color: #926F34">{{$searched_item}} Results </h3>
              
          </div>
      
    </div>
    </div><!-- comment -->
    </div> --}}
    
    

  <div class="site-section">
    <div class="container">

      <div class="row mb-5">
        <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="h5 text-black">{{$searched_item}} Results <span class="badge rounded-pill bg-secondary text-light">{{ count($results_products) }}</span></h2><hr></div>
                {{-- {{ count($boutique_products) }} --}}
                
                
              </div>
            </div>



        <div class="row mb-5">

            
@foreach ($results_products as $product)
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
            <div class="mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
              <div id="slider-range" class="border-primary"></div>
              <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
            </div>

            <div class="mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
              <label for="s_sm" class="d-flex">
                <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Small (2,319)</span>
              </label>
              <label for="s_md" class="d-flex">
                <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span class="text-black">Medium (1,282)</span>
              </label>
              <label for="s_lg" class="d-flex">
                <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span class="text-black">Large (1,392)</span>
              </label>
            </div>

            <div class="mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
              <a href="#" class="d-flex color-item align-items-center" >
                <span class="bg-danger color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Red (2,429)</span>
              </a>
              <a href="#" class="d-flex color-item align-items-center" >
                <span class="bg-success color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Green (2,298)</span>
              </a>
              <a href="#" class="d-flex color-item align-items-center" >
                <span class="bg-info color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Blue (1,075)</span>
              </a>
              <a href="#" class="d-flex color-item align-items-center" >
                <span class="bg-primary color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Purple (1,075)</span>
              </a>
            </div>

        </div>

        </div>
      

      
    </div>
  </div>

@endsection