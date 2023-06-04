@extends('vendor.vendor_dashboard')
@section('vendor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                </ol>
            </nav>
        </div>
        
    </div>
    <!--end breadcrumb-->

  <div class="card">
      <div class="card-body p-4">
          <h5 class="card-title">Edit Product  #{{$products->id}}</h5>
          <hr/>

          <form id="myForm" method="post" action="{{ route('vendor.update.product') }}" enctype="multipart/form-data" >
            @csrf


            <input type="hidden" name="id" value="{{ $products->id }}">


           <div class="form-body mt-4">
            <div class="row">
               <div class="col-lg-8">
               <div class="border border-3 p-4 rounded">



                <div class="form-group mb-3">
                    <label class="form-label">Product Name</label>
                    <input value="{{$products->product_name}}" type="text" class="form-control" id="product_name" placeholder="Enter product name" name="product_name">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Product Tags</label>
                    <input value="{{$products->tags}}" type="text" class="form-control visually-hidden" data-role="tagsinput" value="Clothes, New Product" id="tags" placeholder="Enter product Tags" name="tags">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Product Sizes</label>
                    <input value="{{$products->product_size}}" type="text" class="form-control visually-hidden" data-role="tagsinput" id="product_tags" placeholder="Enter product Sizes" name="product_size">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Product Colors</label>
                    <input value="{{$products->product_color}}" type="text" class="form-control visually-hidden" data-role="tagsinput" id="product_tags" placeholder="Enter product Colors" name="product_color">
                </div>

                  
                  <div class="form-group mb-3">
                    <label for="inputProductShortDescription" class="form-label">Short Description</label>
                    <textarea class="form-control" id="inputProductShortDescription" rows="2" name="short_desc">{{$products->short_desc}}</textarea>
                  </div>

                  <div class="form-group mb-3">
                    <label for="inputProductLongDescription" class="form-label">Long Description</label>
                    <textarea class="form-control" id="inputProductShortDescription" rows="4" name="long_desc">{{$products->long_desc}}</textarea>
                  </div>

                  {{-- image fields has been removed from here --}}

                </div>
               </div>
               <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">
                  <div class="row g-3">
                    <div class="form-group col-md-6">
                        <label for="selling_price" class="form-label">Product Price</label>
                        <input value="{{$products->selling_price}}" type="text" name="selling_price" class="form-control" id="selling_price">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="discount_price" class="form-label">Discount Price</label>
                        <input value="{{$products->discount_price}}" type="text" name="discount_price" class="form-control" id="discount_price" >
                      </div>
                      
                      <div class="form-group col-md-12">
                        <label for="product_qty" class="form-label">Product Quantity</label>
                        <input value="{{$products->product_qty}}"  type="text" name="product_qty" class="form-control" id="product_qty">
                      </div>

                      <div class="form-group col-12">
                        <label for="product_code" class="form-label">Product Code</label>
                        <input value="{{$products->product_code}}"  type="text" name="product_code" class="form-control" id="product_code">
                      </div>
                      

                    <div class="form-group col-12">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{$category->id == $products->category_id ? 'selected' : ''}} >{{ $category->category_name }}</option>
                            @endforeach
          
                          </select>
                    </div>


                    <div class="form-group col-12">
                        <label for="subcategory_id" class="form-label">Sub Category</label>
                        <select name="subcategory_id" class="form-select">
                          
                            @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{$subcategory->id == $products->subcategory_id ? 'selected' : ''}} >{{ $subcategory->subcategory_name }}</option>
                        @endforeach
                          </select>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form check">
                            <input class="form-check-input" name="length_needed" type="checkbox" value="1" id="" {{ $products->length_needed == 1 ? 'checked' : ''}}>
                            <label for="length_needed" class="form-check-label">Length Needed</label>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form check">
                            <input class="form-check-input" name="on_sale" type="checkbox" value="1" id="" {{ $products->on_sale == 1 ? 'checked' : ''}}>
                            <label for="on_sale" class="form-check-label">On Sale</label>
                        </div>
                    </div>
                      
                      <div class="col-12">
                          <div class="d-grid">
                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                          </div>
                      </div>
                  </div> 
              </div>
              </div>
           </div><!--end row-->
        </div>
      </form>

      </div>
       
  </div>

</div>




{{-- main image update --}}
<div class="page-content">
    <h6 class="mb-0">Update the Product`s Main Image</h6>
    <hr>
    <div class="card">
    <form method="post" action="{{ route('vendor.update.product.thumbnail') }}" enctype="multipart/form-data" >
        @csrf

        <input type="hidden" name="id" value="{{$products->id}}">
        <input type="hidden" name="old_image" value="{{$products->product_thumbnail}}">

    <div class="card-body">


    <div class="mb-3">
    <label class="form-label">Choose Main Photo</label>
    <input type="file" class="form-control" id="formFile" name="product_thumbnail">
    </div>     

    <div class="mb-3">        
        <img src="{{ asset($products->product_thumbnail) }}" style="width:150px; height:180px;">
    </div> 
    
    <input type="submit" class="btn btn-primary px-4" value="Save Changes" />

    
    
    </div>
    </form>
    </div>
</div>

{{-- muliti images update --}}

<div class="page-content">
    <h6 class="mb-0">Update the Product`s Multiple Image</h6>
    <hr>

    <div class="card">
    <div class="card-body">



    <table class="table mb-0 table-striped">
        <thead>
            <tr>
                <th scope="col">Sl</th>
                <th scope="col">Image</th>
                <th scope="col">Change Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <form method="post" action="{{ route('vendor.update.product.multiimage') }}" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="id" value="{{$products->id}}">

                @foreach ($multiImgs as $key => $img)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td><img src="{{ asset($img->photo_name) }}" style="width:130px; height:150px;"></td>
                <td><input type="file" class="form-group" name="multi_img[{{$img->id}}]"></td>
                <td>
                    <input type="submit" class="btn btn-primary px-4" value="Update Image" />
                    <a href="{{ route('vendor.delete.product.multiimage',$img->id) }}" class="btn btn-danger" id="delete">Delete</a>
                </td>
            </tr>

                @endforeach


            </form>
        </tbody>
    </table>

    

    
    
    </div>
    
    </div>
</div>




{{-- script for validation  --}}
<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
              product_name: {
                  required : true,
              }, 
              product_size: {
                  required : true,
              }, 
              product_color: {
                  required : true,
              }, 
              product_thumbnail: {
                  required : true,
              }, 
              selling_price: {
                  required : true,
              }, 
              product_qty: {
                  required : true,
              }, 
              category_id: {
                  required : true,
              }, 
          },
          messages :{
            product_name: {
                  required : 'Please Enter Product Name',
              },
              product_size: {
                required : 'Please Enter Product Sizes',
              }, 
              product_color: {
                required : 'Please Enter Product Colors',
              }, 
              product_thumbnail: {
                required : 'Please Enter Product Image',
              }, 
              selling_price: {
                required : 'Please Enter Product Price',
              }, 
              product_qty: {
                required : 'Please Enter Product Quantity',
              }, 
              category_id: {
                required : 'Please Choose Category',
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

{{-- script for loading and showing the main image when selected --}}
<script type="text/javascript">
function mainImageUrl(input){
if(input.files && input.files[0]){
  var reader = new FileReader();
  reader.onload = function(e){
    $('#mainImage').attr('src', e.target.result).width(80).height(80);
  }
  reader.readAsDataURL(input.files[0]);
}
}

</script>


{{-- script for loading and showing the multiple images when selected --}}
<script> 
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>


{{-- script to load the sub categories of the selected category --}}
<script type="text/javascript">

  $(document).ready(function(){
    $('select[name="category_id"]').on('change', function(){
      var category_id = $(this).val();
      if(category_id){
        $.ajax({
          url: " {{url('/subcategory/ajax') }}/"+category_id,
          type: "GET",
          dataType: "json", 
          success:function(data){
            $('select[name="subcategory_id"]').html('');
            var d = $('select[name="subcategory_id"]').empty();
            $.each(data, function(key, value){

              $('select[name="subcategory_id"]').append('<option value="'+value.id+'">' + value.subcategory_name+'</option>');

            });
          },
        });
      } else{
        alert('danger');
      }
    });
  });
</script>


@endsection