@php
$boutiques = App\Models\User::where('role', 'vendor')->where('status', 'active')->limit(8)->get();  
@endphp

@if(count($boutiques) >= 3)

<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 site-section-heading text-center pt-4">
          <h2>Boutiques</h2>
          
          <a href="{{route('boutique.all')}}" style="font-size: 18px;"><p >All Boutiques >></p></a>
        </div>
        
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="nonloop-block-3 owl-carousel">

            @foreach ($boutiques as $boutique)
                
            
            <div class="item">
              <div class="text-center" style="background-color: transparent">
                <figure class="block-4-image">
                  <a href="{{route('boutique.details', $boutique->id)}}">
                  <img style="height: 300px; width:300px;" src="{{url('uploud/vendor_images/'.$boutique->photo)}}" alt="Image placeholder" class="img-fluid rounded-circle" style="height:250px; width=50px;">
                  </a>
                </figure>
                {{-- <div class="block-4-text p-4">
                  <h3><a href="#">{{$boutique->boutiqueName}}</a></h3> --}}
                 {{-- <p class="mb-0">Finding perfect t-shirt</p>
                  <p class="text-primary font-weight-bold colored-p">$50</p>
                </div>  --}}
              </div>
            </div>
            @endforeach


          </div>
        </div>
      </div>
    </div>
  </div>


  @endif