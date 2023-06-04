@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Coupon Poster</div>
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
                                <img src="{{url('images/couponPost.png')}}"  height="500" width="500">
                                <div style="position: absolute; top: 36%; left: 24%; transform: translate(-50%, -50%);">
                                    <h2 style="font-size: 80px; color: #926F34; ">{{$coupon->coupon_discount}}<span style="color: #DFBD69; font-size:40px;">%</span></h2>
                                </div>
                                <div style="position: absolute; top: 65%; left: 24%; transform: translate(-50%, -50%);">
                                    <h5 style="color: black;">{{$coupon->coupon_code}}</h5>
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