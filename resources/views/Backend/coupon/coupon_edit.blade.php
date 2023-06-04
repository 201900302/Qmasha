@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Coupon System</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Coupon #{{$coupon->id}} </li>
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

<form id="myForm" method="post" action="{{ route('update.coupon') }}" >
@csrf

<input type="hidden" name="id" value="{{$coupon->id}}">
<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Coupon Code</h6>
    </div>
    <div class="form-group col-sm-9 text-secondary">
        <input type="text" name="coupon_code" class="form-control" value="{{$coupon->coupon_code}}"/>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Coupon Discount (%)</h6>
    </div>
    <div class="form-group col-sm-9 text-secondary">
        <input type="number" name="coupon_discount" class="form-control" value="{{$coupon->coupon_discount}}"/>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Coupon Validity</h6>
    </div>
    <div class="form-group col-sm-9 text-secondary">
        <input type="date" name="coupon_validity_date" class="form-control" min="{{Carbon\Carbon::now()->format('d/m/Y')}}" value="{{$coupon->coupon_validity_date}}"/>
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
    coupon_code: {
        required : true,
    }, 
    coupon_discount: {
        required : true,
    }, 
    coupon_validity_date: {
        required : true,
    }, 
    
},
messages :{
    coupon_code: {
        required : 'Please Enter Coupon Code',
    },
    coupon_discount: {
        required : 'Please Enter Coupon Discount',
    },
    coupon_validity_date: {
        required : 'Please Enter Coupon Validity Date',
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