@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Shipping </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Shipping Area #{{$shippingArea->id}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">

<div class="col-lg-10">
<div class="card">
<div class="card-body">

<form id="myForm" method="post" action="{{ route('update.shippingArea') }}" >
@csrf

<input type="hidden" value="{{$shippingArea->id}}" name="id">

<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Country Name</h6>
    </div>
    <div class="form-group col-sm-9 text-secondary">
        <input type="text" name="country_name" class="form-control" value="{{$shippingArea->country_name}}"/>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Shipping Cost (BHD)</h6>
    </div>
    <div class="form-group col-sm-9 text-secondary">
        <input type="number" name="shipping_cost" class="form-control" value="{{$shippingArea->shipping_cost}}"/>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Cities</h6>
    </div>
    <div class="form-group col-sm-9 text-secondary">
        <input type="text" value="{{$shippingArea->country_cities}}" class="form-control visually-hidden" data-role="tagsinput" id="country_cities" placeholder="Enter the cities available for shipping" name="country_cities">
    </div>
</div>


<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-9 text-secondary">
        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
    </div>
</div>
</div>

</form>



</div>

                </div>
            </div>
        </div>
    </div>
</div>






<script type="text/javascript">
$(document).ready(function (){
$('#myForm').validate({
rules: {
    country_name: {
        required : true,
    }, 
    shipping_cost: {
        required : true,
    }, 
    country_cities: {
        required : true,
    }, 
    
},
messages :{
    country_name: {
        required : 'Please Enter Country Name',
    },
    shipping_cost: {
        required : 'Please Enter Shipping Cost',
    },
    country_cities: {
        required : 'Please Enter Cities',
    },
},
errorElement : 'span', 
errorPlacement: function (error,element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
},
highlight : function(element, errorClass, validClass){
    $(element).addClass('is-invalid');
},
unhighlight : function(element, errorClass, validClass){
    $(element).removeClass('is-invalid');
},
});
});

</script>


@endsection