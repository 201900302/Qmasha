@extends('frontend.master_dashboard')
@section('main')


<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$product['category']['category_name']}}</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">{{$product['subcategory']['subcategory_name']}}</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">{{$product->product_name}}</strong></div>
      </div>
    </div>
  </div>
  
  {{-- ok --}}



  <div class="site-section">
    <div class="container">


{{-- ok --}}
      <div class="row">

        <div class="col-md-6">


            @if ($product->discount_price != null || $product->discount_price > 0) 

            @php
            $amount = $product->selling_price - $product->discount_price;
            $discount = ($amount/$product->selling_price)*100;
          
            @endphp
          
          
            <div class="product-badges product-badges-position product-badges-mrg">
            <span class="hot">On Sale</span>
            </div>
            @endif

            
          <img src="{{ url($product->product_thumbnail)}}" alt="Image" class="product_main_image">


          {{-- other images --}}

          <div class="site-section block-3 site-blocks-2 pt-0">
              <div class="nonloop-block-3 owl-carousel">

                @foreach ($multiImage as $image)
                    
                <div class="item">
                  
                    <figure class="block-4-image">
                      <img src="{{asset($image->photo_name)}}" alt="Image placeholder" class="product_multi_image">
                    </figure>
                  
                </div>
                @endforeach
              </div>
          </div>
        </div>
        <div class="col-md-6">
            @if($product->product_qty == 0 || $product->product_qty == null || $product->status == 0  )
            <span style="font-size: 15px" class="badge rounded-pill bg-secondary text-light">This Item Is Out Of Stock</span><br><br>
            @endif
          <h2 class="text-black" id="pname" name="pname">{{$product->product_name}}</h2>


          {{-- rating system --}}

          @php
          $reviews_avg = number_format((float)(App\Models\Review::where('product_id', $product->id)->where('status', 1)->avg('rate')), 2);
          $reviews_count = count(App\Models\Review::where('product_id', $product->id)->where('status', 1)->latest()->get());
          @endphp

          <div class="product-detail-rating">
            <div class="product-rate-cover text-end">
                <div class="product-rate d-inline-block">
                    <div class="product-rating" style="width: {{$reviews_avg*20}}%"></div>
                </div>
                <span class="font-small ml-1 text-muted"> ({{$reviews_count}} reviews)</span>
            </div>
        </div>
        {{-- rating system --}}

          <div style="display: flex;">
            <i class="bi bi-shop"></i><h6 id="pvendorname" name="pvendorname" style="margin-top: 11px; padding-left:10px;"><a href="{{route('boutique.details', $product->vendor_id)}}"> {{$product['vendor']['boutiqueName']}}</a></h6>
            </div>
            <p>{{$product->short_desc}}</p>
          <p class="mb-4">{{$product->long_desc}}</p>
          @if($product->discount_price == null || $product->discount_price == 0)
          <p><strong class="text-primary h4" id="pprice">{{$product->selling_price}} BHD</strong></p>
          @else
          <div style="display: flex;">

            <div style="display: block">
                <span class="save-price">{{round($discount)}} % Off</span>
          <span style="font-size: 20px;" class="old-price" id="oldprice">{{$product->selling_price}} BHD </span>
            </div>
        
          <p style="padding-top: 25px; padding-left: 20px;"><strong class="text-primary h4" id="pnewprice">{{$product->discount_price}} BHD</strong></p>

            </div>
          @endif

          {{-- <p><strong class="text-primary h4">$50.00</strong></p> --}}
          <div class="d-flex">
           
              <div class="col-lg-6">
            <p><strong>Size</strong></p>
              </div>
              <div class="col-lg-6">
            <p><strong>Color</strong></p>
          </div>
          </div>


          <div class="mb-1 d-flex">
          
            {{-- <p style="padding-right: 10px" class="pt-2"><strong>Size</strong></p> --}}
            @if($product->product_size == NULL)
            @else
            <div class="form-group col-md-6 pl-0">
            <select class="form-control unicase-form-control" id="size" name="size">
                {{-- <option selected="" disabled="">Choose Size</option> --}}
            @foreach ($product_size as $size)
            <option value="{{$size}}">{{ucwords($size)}}</option>
            @endforeach
            
            </select>
            </div>
            @endif
            {{-- <p style="padding-right: 10px" class="pt-2"><strong>Color</strong></p> --}}
            @if($product->product_color == NULL)
            @else
            <div class="form-group col-md-6 pl-0">
            <select class="form-control unicase-form-control" id="color" name="color">
                {{-- <option selected="" disabled="">Choose Color</option> --}}
            @foreach ($product_color as $color)
            <option value="{{$color}}">{{ucwords($color)}}</option>
            @endforeach
            
            </select>
            </div>
            @endif
            </div>

            


         {{-- <p><strong class="text-primary h4">$50.00</strong></p> --}}
      

         <div class="mb-1 d-flex">
            
                @if($product->length_needed == 0)
                {{-- <input type="hidden" id="length" name="length" value="-"> --}}
                @else
                <div class="form-group col-md-6 pl-0">
                <div class="form-group col-md-6 pl-0">
                    <input style="width: max-content" type="text" class="form-control" placeholder="Enter length" id="length" name="length">
                </div></div>
                @endif
            <div class="form-group col-md-6 pl-0">
            <div class="input-group mb-3" style="max-width: 120px;">
            <div class="input-group-prepend">
              <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
            </div>
            <input type="text" class="form-control text-center" value="1" aria-label="Example text with button addon" aria-describedby="button-addon1" id="qty" name="qty" min="1">
            <div class="input-group-append">
              <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
            </div>
          </div>
            </div>
            

          </div>

          @if($product->product_qty <= 0 || $product->product_qty == null || $product->status == 0  )
          <button type="submit" class="btn btn-sm">Add <i class="fa fa-shopping-cart" aria-hidden="true" onclick="addToCart()" disabled></i></button>
          @else
            {{-- hidden input to pass the product id to the cart  --}}
            <input type="hidden" id="product_id" value="{{$product->id}}"> 
            <input type="hidden" id="vproduct_id" value="{{$product->vendor_id}}"> 

            <button type="submit" class="btn btn-sm" onclick="addToCart()">Add <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
            <a id="{{$product->id}}" onclick="addToWishlist(this.id)" aria-label="Add To Wishlist" class="btn btn-sm favProductBtn"><i class="fa fa-heart" aria-hidden="true"></i></a>

            @endif

            <div style="font-size: 12px; padding-top:20px;">
            
            <h6 style="margin-bottom: -15px">Product Details: </h6>
            <hr>
                <p style="margin-top: -5px"><strong>Category: </strong><span id="pcategory" name="pcategory">{{$product['category']['category_name']}}</span></p>
                <p style="margin-top: -16px"><strong>Sub Category: </strong><span id="psubcategory" name="psubcategory">{{$product['subcategory']['subcategory_name']}}</span></p>
                {{-- <p style="margin-top: -16px"><strong>Vendor Id: </strong><span id="pvendor_id" name="pvendor_id">{{$product->vendor_id}}</span></p> --}}

                @if($product->product_code == NULL)
                @else
                <p style="margin-top: -16px"><strong>Product Code: </strong>{{$product->product_code}}</p>
                @endif
                @if($product->tags == NULL)
                @else
                <p style="margin-top: -16px"><strong>Product Tags: </strong>{{$product->tags}}</p>
                @endif
            
          </div>



        </div>
        
        </div>
    
{{-- ok --}}

          

{{-- ok --}}
<div class="site-section border-bottom" data-aos="fade">
    <div class="container">

    <div class="row mb-5">

      <div class="col-lg-4">

          <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
              <a href="#tab1" class="nav-link active" data-toggle="pill" role="tab" aria-controls="tab1" aria-selected="true">
                  <span class="icon-account_circle"></span> Vendor Info
              </a>

              <a href="#tab2" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab2" aria-selected="false">
                  <span class="icon-shopping-bag"></span> Customer Reviews
              </a>
              

              
              
          </div>
          
          
      </div>
             
             
      <div class="col-lg-8">
          <div class="tab-content" id="faq-tab-content">

              <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                  <div class="accordion" id="accordion-tab-1">
                      <div class="card">
                                          <div class="card-header">
                                              <h3 class="mb-0">Vendor Info</h3>
                                          </div>
                                          <div class="card-body">
                                            <div style="display: flex;">
                                                <i class="bi bi-shop"></i><h6 style="margin-top: 11px; padding-left:10px;"><a href="{{route('boutique.details', $product->vendor_id)}}"> {{$product['vendor']['boutiqueName']}}</a></h6>
                                                </div>
        
                
                                                <div style="display: flex;">
                                                    <i class="bi bi-instagram"></i></i><p style="margin-top: 5px; padding-left:10px;"><a href="{{$product['vendor']['account_URL']}}">{{$product['vendor']['account_URL']}}</a></p>
                                                    </div>
        
                                                    <p>{{$product['vendor']['vendor_description']}}</p>
        
                                            
                                          </div>
                      </div>

                  </div>
              </div>
              
              <div class="tab-pane show" id="tab2" role="tabpanel" aria-labelledby="tab2">
                  <div class="accordion" id="accordion-tab-2">
                      <div class="card">
                          
                          <div class="card-header">
                              <h3 class="mb-0">Review</h3>
                          </div>
                          <div class="card-body">



                            @php
                            $counter = count(App\Models\Review::where('product_id', $product->id)->where('status', 1)->latest()->get());
                            if($counter > 0){
                              $reviews_avg_total = number_format((float)(count(App\Models\Review::where('product_id', $product->id)->where('status', 1)->latest()->get())), 2);

                            $reviews_avg_5_star =  number_format((float)(count(App\Models\Review::where('product_id', $product->id)->where('status', 1)->where('rate', 5)->latest()->get())*100/$reviews_avg_total), 2);
                            $reviews_avg_4_star =  number_format((float)(count(App\Models\Review::where('product_id', $product->id)->where('status', 1)->where('rate', 4)->latest()->get())*100/$reviews_avg_total), 2);
                            $reviews_avg_3_star =  number_format((float)(count(App\Models\Review::where('product_id', $product->id)->where('status', 1)->where('rate', 3)->latest()->get())*100/$reviews_avg_total), 2);
                            $reviews_avg_2_star =  number_format((float)(count(App\Models\Review::where('product_id', $product->id)->where('status', 1)->where('rate', 2)->latest()->get())*100/$reviews_avg_total), 2);
                            $reviews_avg_1_star =  number_format((float)(count(App\Models\Review::where('product_id', $product->id)->where('status', 1)->where('rate', 1)->latest()->get())*100/$reviews_avg_total), 2);

                            }
                            
                            // $reviews_avg_5_star = number_format((float)($reviews_avg_5), 2);
                            @endphp


                            @if($counter > 0)
                            <div class="col-lg-12">
                              {{-- <h4 class="mb-30">Customer reviews</h4> --}}
                              <div class="d-flex mb-30">
                                  <div class="product-rate d-inline-block mr-15">
                                      <div class="product-rating" style="width: {{$reviews_avg*20}}%"></div>
                                  </div>
                                  <h6 class="ml-2">{{$reviews_avg}} out of 5</h6>
                              </div>
                              <div class="progressRate">
                                  <span>5 star</span>
                                  <div class="progressRate-bar" role="progressbar" style="width: {{$reviews_avg_5_star}}%" aria-valuenow="{{$reviews_avg_5_star}}" aria-valuemin="0" aria-valuemax="100">{{$reviews_avg_5_star}}%</div>
                              </div>
                              <div class="progressRate">
                                  <span>4 star</span>
                                  <div class="progressRate-bar" role="progressbar" style="width: {{$reviews_avg_4_star}}%" aria-valuenow="{{$reviews_avg_4_star}}" aria-valuemin="0" aria-valuemax="100">{{$reviews_avg_4_star}}%</div>
                              </div>
                              <div class="progressRate">
                                  <span>3 star</span>
                                  <div class="progressRate-bar" role="progressbar" style="width: {{$reviews_avg_3_star}}%" aria-valuenow="{{$reviews_avg_3_star}}" aria-valuemin="0" aria-valuemax="100">{{$reviews_avg_3_star}}%</div>
                              </div>
                              <div class="progressRate">
                                  <span>2 star</span>
                                  <div class="progressRate-bar" role="progressbar" style="width: {{$reviews_avg_2_star}}%" aria-valuenow="{{$reviews_avg_2_star}}" aria-valuemin="0" aria-valuemax="100">{{$reviews_avg_2_star}}%</div>
                              </div>
                              <div class="progressRate mb-30">
                                  <span>1 star</span>
                                  <div class="progressRate-bar" role="progressbar" style="width: {{$reviews_avg_1_star}}%" aria-valuenow="{{$reviews_avg_1_star}}" aria-valuemin="0" aria-valuemax="100">{{$reviews_avg_1_star}}%</div>
                              </div>
                              {{-- <a href="#" class="font-xs text-muted">How are ratings calculated?</a> --}}
                          </div>
                          @else
                          <p>No Reviews Yet</p>
                          @endif

                            <div class="col-lg-12 pt-5">
                              <h5 class="mb-30 text-black">Customer Comments</h5>
                              <hr>
                              <div class="comment-list">

                                @php
                                  $approved_product_reviews = App\Models\Review::where('product_id', $product->id)->where('status', 1)->latest()->limit(10)->get();
                                @endphp

                                @foreach ($approved_product_reviews as $review)

                                
                                <div class="single-comment justify-content-between d-flex mb-30">
                                  <div class="user justify-content-between d-flex">
                                      
                                      <div class="desc">
                                        <span class="font-xs text-primary">{{$review['user']['name']}}</span>
                                          <div class="d-flex justify-content-between mb-10">
                                              
                                              <div class="d-flex align-items-center">
                                                  <span class="font-xs text-muted">{{$review->created_at->format('d F Y')}}</span>
                                              </div>
                                              <div class="product-rate d-inline-block ml-2 mt-1">
                                                  <div class="product-rating" style="width: {{$review->rate*20}}%"></div>
                                              </div>
                                          </div>
                                          <p class="mb-10">{{$review->comment}}</p>
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
              
              
            
              
              
              
              
              
              


          </div>
      </div>
  </div>

    </div>
</div>
{{-- ok --}}




<div class="site-section">
  <div class="container">


{{-- ok --}}
    <div class="row">




      <div class="comment-form">
        <div class="row">
          <div style="color: black" class="col-md-7 pt-4">
            <h4>Add a Review</h4><hr>
          </div>
        </div>
        <div class="product-rate d-inline-block mb-30"></div>

    @guest
    <p> <b>To Be Able To Add Product Review. You Need To <a href="{{ route('login')}}">Login </a> </b></p>

    @else 


        <div class="row">
            <div class="col-lg-12 col-md-12">
                <form method="POST" class="form-contact comment_form" action="{{route('store.review')}}" id="commentForm">
                  @csrf
                  <input type="hidden" value="{{$product->id}}" name="product_id">
                  <input type="hidden" value="{{$product->vendor_id}}" name="vendor_id">
                    <div class="row">

                      
                      <div class="col-lg-4">


                        <table class="table" style=" width: 60%;">
                            <thead>
                                <tr>
                                    <th class="cell-level">&nbsp;</th>
                                    <th>1 star</th>
                                    <th>2 star</th>
                                    <th>3 star</th>
                                    <th>4 star</th>
                                    <th>5 star</th>
                                </tr>
                            </thead>

                                        <tbody>
                                            <tr>
                                              <td class="cell-level">Rate</td>
                                              <td><input type="radio" name="rate" class="radio-sm" value="1"></td>
                                              <td><input type="radio" name="rate" class="radio-sm" value="2"></td>
                                              <td><input type="radio" name="rate" class="radio-sm" value="3"></td>
                                              <td><input type="radio" name="rate" class="radio-sm" value="4"></td>
                                              <td><input type="radio" name="rate" class="radio-sm" value="5"></td>
                                            </tr>
                                        </tbody>
                        </table>

                      </div>  
                      
                      
                      <div class="col-lg-8">
                            <div class="form-group">
                              <label>Comment: </label>
                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="7" placeholder="Write Comment"></textarea>
                            </div>
                        </div>
                        <div class="col-4"></div>
                        
                        <div class="col-4">
                            <div class="form-group">
                              <label>Name: </label>
                                <input class="form-control" name="name" id="name" type="text" value="{{Auth::user()->name}}" disabled/>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                              <label>Email: </label>
                                <input class="form-control" name="email" id="email" type="email" value="{{Auth::user()->email}}" disabled/>
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="website" id="website" type="text" placeholder="Website" />
                            </div>
                        </div> --}}
                        {{-- <div class="col-sm-4">
                        <div class="form-group">
                             <button type="submit" class="btn btn-sm">Submit Review</button>
                        </div>
                        </div> --}}

                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-sm" style="float: right">Submit Review</button>
                 </div>
                    
                </form>
            </div>
        </div>

  @endguest
      </div>











      
    </div>
  </div>
</div>
















      {{-- related products --}}
      
<div class="site-wrap">
<div class="site-section block-3 site-blocks-2">
    <div class="container">
      <div class="row">
        <div style="color: black" class="col-md-7 pt-4">
          <h4>Related Products</h4><hr>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div style="" class="nonloop-block-3 owl-carousel">


@foreach ($relatedProduct as $product)

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
                  <h5><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{$product->product_name}}</a></h5>
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

{{-- ok --}}



</div>
</div>















              {{-- </div>
      </div>
    </div>
  </div> --}}
@endsection