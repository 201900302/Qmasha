@extends('frontend.master_dashboard')
@section('main')

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">All Collections</strong></div>
      </div>
    </div>
  </div>
    
    

  <div class="site-section">
    <div class="container">

      <div class="row mb-5">
        <div class="col-md-12 order-2">

            <div class="row">
                <div class="col-md-12">
                  <div class="float-md-left mb-4"><h2 class="h5 text-black">List Of All Collections <span class="badge rounded-pill bg-secondary text-light">{{ count($categories) }}</span></h2><hr></div>
                </div></div>  
            <div class="row mb-5">

                 

            @foreach ($categories as $category)

            <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                <a class="block-2-item" href="{{url('product/category/'.$category->id.'/'.$category->category_slug)}}">
                  <figure class="image">
                    <img src="{{url($category->category_image)}}" alt="categoryImage" class="img-fluid">
                  </figure>
                  <div class="text">
                    <h3>{{$category->category_name}}</h3>
                    <span class="text-uppercase">Collection</span>
                  </div>
                </a>
              </div>
              
              @endforeach

            </div>
         
          </div>

        
      </div>

      
    </div>
  </div>


@endsection