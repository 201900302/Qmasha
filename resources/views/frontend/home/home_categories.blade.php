@php
$categories = App\Models\Category::limit(3)->get();  
@endphp

<div class="site-section site-blocks-2">
    <div class="container">
        
        <div class="row justify-content-center">
        <div class="col-md-7 site-section-heading text-center pt-4">
          <h2>Our Collections</h2>
        </div>
        </div>
        
      <div class="row">


@foreach ($categories as $category)
    

        <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
          <a class="block-2-item" href="{{url('product/category/'.$category->id.'/'.$category->category_slug)}}">
            <figure class="image">
              <img src="{{$category->category_image}}" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <span class="text-uppercase">Collection</span>
              <h3>{{$category->category_name}}</h3>
            </div>
          </a>
        </div>

@endforeach       
        
      </div>
    </div>
  </div>