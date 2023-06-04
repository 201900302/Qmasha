@extends('vendor.vendor_dashboard')

@section('vendor')

@php
    $vendor_logo = Auth::user()->photo;
@endphp


<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor Poster</div>
        <div class="ps-3">
          
            <button onclick="downloadimage()" class="btn btn-warning">Click To Download The Poster</button>

        </div>
       
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        
                            <div id="htmltoimage" style="width: fit-content">
                                <img src="{{url('images/boutiquePost.png')}}"  height="500" width="500">
                                <div style="position: absolute; top: 25%; left: 24%; transform: translate(-50%, -50%);">
                                <img  src="{{url('uploud/vendor_images/'.$vendor_logo)}}"  height="180" width="180" style="border-radius: 100px;-webkit-box-shadow: 2px 2px 5px 0px rgba(0, 0, 0, 1); -moz-box-shadow: 2px 2px 5px 0px rgba(0, 0, 0, 1); box-shadow: 2px 2px 5px 0px rgba(0, 0, 0, 1);">
                                </div>
                              </div>                              
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('adminbackend/assets/js/html2canvas.js')}}"></script>

<script type="text/javascript">

    function downloadimage() {
        /*var container = document.getElementById("image-wrap");*/ /*specific element on page*/
        var container = document.getElementById("htmltoimage");; /* full page */
        html2canvas(container, { allowTaint: true }).then(function (canvas) {

            var link = document.createElement("a");
            document.body.appendChild(link);
            link.download = "html_image.jpg";
            link.href = canvas.toDataURL();
            link.target = '_blank';
            link.click();
        });
    }

</script>


@endsection