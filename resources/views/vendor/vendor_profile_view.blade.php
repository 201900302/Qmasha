@extends('vendor.vendor_dashboard')

@section('vendor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor User Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Profile</li>
                </ol>
            </nav>
        </div>
       
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ (!empty($vendorData->photo)) ? url('uploud/vendor_images/'.$vendorData->photo): url('images/icons/person-circle-white.svg') }}" alt="Vendor" class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    <h4>{{$vendorData->name}}</h4>
                                    <p class="text-secondary mb-1">{{$vendorData->role}}</p>
                                    
                                </div>
                            </div>
                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                                
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                                    <span class="text-secondary">{{$vendorData->account_URL}}</span>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">


                            <form method="POST" action="{{ route('vendor.profile.store') }}" enctype="multipart/form-data">
                                @csrf



                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="name" class="form-control" value="{{$vendorData->name}}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Boutique Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="boutiqueName" class="form-control" value="{{$vendorData->boutiqueName}}" />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Boutique Join Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                        
                                    <input type="text" name="vendor_join_date" class="form-control" value="{{$vendorData->vendor_join_date}}" disabled />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Boutique Description</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea class="form-control" name="vendor_description" id="inputAddress" rows="3" >{{$vendorData->vendor_description}}</textarea>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Instagram URL</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="account_URL" placeholder="https://example.com/users/" value="{{$vendorData->account_URL}}" />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="email" name="email" class="form-control"  value="{{$vendorData->email}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="phone" class="form-control"  value="{{$vendorData->phone}}" />
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="address" class="form-control"  value="{{$vendorData->address}}" />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Boutique Logo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="file" name="photo" class="form-control" id="image" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"> </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <img id="showImage" src="{{ (!empty($vendorData->photo)) ? url('uploud/vendor_images/'.$vendorData->photo): url('images/icons/person-circle-white.svg') }}" alt="Vendor" class="p-1 bg-primary" width="110">

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

$(document).ready(function(){

    $('#image').change(function(e){

        var reader = new FileReader();
        reader.onload = function(e){
            $('#showImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(e.target.files['0']);
    })


});


</script>
@endsection