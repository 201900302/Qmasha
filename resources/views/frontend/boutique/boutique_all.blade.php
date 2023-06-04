@extends('frontend.master_dashboard')
@section('main')

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">All Boutiques</strong></div>
      </div>
    </div>
  </div>
    
    

  <div class="site-section">
    <div class="container">

      <div class="row mb-5">
        <div class="col-md-12 order-2">

            <div class="row">
                <div class="col-md-12">
                  <div class="float-md-left mb-4"><h2 class="h5 text-black">List Of All Boutiques <span class="badge rounded-pill bg-secondary text-light">{{ count($boutiques) }}</span></h2><hr></div>
                </div></div>  
            <div class="row mb-5">

                 

            @foreach ($boutiques as $boutique)

              <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <a href="{{route('boutique.details', $boutique->id)}}">
                <div class="block-4 text-center border">
                    <figure class="block-4-image pt-4">
                      <img style="height: 200px; width: 200px; box-shadow: 10px 10px 5px #ccc;" src="{{url('uploud/vendor_images/'.$boutique->photo)}}" class="rounded-circle" alt="Image placeholder">
                    </figure>

                    <div class="block-4-text p-4">
                        <p class="text-primary font-weight-bold colored-p">{{$boutique->boutiqueName}}</p>                  
                        <p class="mb-0" style="color: gray">Since {{$boutique->vendor_join_date}}</p>
                    </div>
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