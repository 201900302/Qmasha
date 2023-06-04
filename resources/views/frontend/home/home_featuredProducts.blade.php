@php
$products = App\Models\Product::where('status', 1)->where('admin_favourite', 1)->limit(6)->get();  
@endphp

@if(count($products) >= 3)

<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 site-section-heading text-center pt-4">
          <h2>Featured Products</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="nonloop-block-3 owl-carousel">


@foreach ($products as $product)

            <div class="item">
              <div class="block-4 text-center">
                @if ($product->discount_price != null || $product->discount_price > 0) 

                @php
                $amount = $product->selling_price - $product->discount_price;
                $discount = ($amount/$product->selling_price)*100;

                @endphp


                <div class="product-badges product-badges-position product-badges-mrg">
                <span class="hot">{{round($discount)}} %</span>
                </div>
                @endif
                <figure class="block-4-image">
                  <img src="{{url($product->product_thumbnail)}}" alt="Image placeholder" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{$product->product_name}}</a></h3>
                  <p class="mb-0">By {{$product['vendor']['boutiqueName']}}</p>                  
                  <p class="text-primary font-weight-bold colored-p">
                    
                    @if ($product->discount_price != null || $product->discount_price > 0) 
                    <span class="old-price">{{$product->selling_price}} BHD</span>
                      {{$product->discount_price}} BHD
                    
                    @else
                      {{$product->selling_price}} BHD
                    
                    @endif
                  
                  </p>
                </div>
              </div>
            </div>
@endforeach
            
            
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endif
