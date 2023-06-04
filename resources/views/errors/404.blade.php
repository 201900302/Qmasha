@extends('frontend.master_dashboard')
@section('main')



    {{-- <head>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head> --}}



    <div class="cart p-5">
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="text-center">
                <h1 class="display-1 fw-bold">404</h1>
                <p class="fs-3"> <span class="text-primary">Opps!</span> Page not found.</p>
                <p class="lead">
                    The page you’re looking for doesn’t exist.
                  </p>
                <a href="{{url('/')}}" class="btn btn-primary">Go Home</a>
            </div>
        </div>
    </div>




@endsection