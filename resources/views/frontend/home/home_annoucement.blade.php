@php
$announcements = App\Models\Poster::where('status', 1)->limit(1)->get();  
@endphp

@foreach ($announcements as $announcement)
    

<div class="site-section block-8">
    <div class="container">
      <div class="row justify-content-center  mb-5">
        <div class="col-md-7 site-section-heading text-center pt-4">
          <h2>Qmasha Announcement</h2>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-12 col-lg-7 mb-5">
          <a href="#"><img src="{{ asset('images/poster_image.png') }}" alt="Image placeholder" class="img-fluid rounded" style="height: 500px; width:500px;"></a>
        </div>
        <div class="col-md-12 col-lg-5 text-center pl-md-5">
          <h2>{{$announcement->poster_title}}</h2>
          <p class="post-meta mb-4">By <a href="#">Qmasha Company</a> <span class="block-8-sep">&bullet;</span> {{$announcement->updated_at->format('d-m-Y')}}</p>
          <p>{{$announcement->poster_body}}</p>
          <p><a href="{{$announcement->poster_url}}" class="btn btn-primary btn-sm">Let`s Go</a></p>
        </div>
      </div>
    </div>
  </div>

  @endforeach
