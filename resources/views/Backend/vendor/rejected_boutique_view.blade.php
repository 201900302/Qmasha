@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Manage Boutiques </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Boutique #{{$vendorData->id}} Details - {{$vendorData->status}} Boutique</li>
                </ol>
            </nav>
        </div>

        {{-- <div class="ms-auto">
            
            
            <div class="btn-group">
            <button style="border-color: transparent; background-color:transparent;" type="submit" form="delete_boutique_form" ><a class="btn btn-danger" id="delete" >Delete from Database</a></button>
            </div>
         
            </div> --}}
        </div>

       
       
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="delete_boutique_form" method="POST" action="{{ route('delete.boutique.approve') }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{$vendorData->id}}">

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="name" class="form-control" value="{{$vendorData->name}}" disabled/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Boutique Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="boutiqueName" class="form-control" value="{{$vendorData->boutiqueName}}" disabled/>
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
                                    <textarea class="form-control" name="vendor_description" id="inputAddress" rows="3" disabled >{{$vendorData->vendor_description}}</textarea>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Instagram URL</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <a href="{{$vendorData->account_URL}}"><input type="text" class="form-control" name="account_URL" value="{{$vendorData->account_URL}}" disabled/></a>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="email" name="email" class="form-control"  value="{{$vendorData->email}}" disabled />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="phone" class="form-control"  value="{{$vendorData->phone}}" disabled />
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="address" class="form-control"  value="{{$vendorData->address}}" disabled/>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Boutique Logo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <img id="showImage" src="{{ (!empty($vendorData->photo)) ? url('uploud/vendor_images/'.$vendorData->photo): url('images/icons/person-circle-white.svg') }}" alt="Vendor" class="p-1 bg-primary" width="110">

                                </div>
                            </div>

                            </form>


                        </div>

                    
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