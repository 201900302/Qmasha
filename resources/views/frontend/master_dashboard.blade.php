<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Qmasha &mdash; E-Commerce Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta name="description" content="" /> --}}

    <meta name="csrf-token" content="{{csrf_token()}}" >



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="{{ asset('frontend/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">


    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >



{{-- chatbot --}}
{{-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('chatbot/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('chatbot/assets/css/main.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{{asset('chatbot/assets/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('chatbot/assets/css/chatBot.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('chatbot/assets/css/timeline.css')}} " rel="stylesheet" type="text/css"/> --}}

{{-- payment  --}}
{{-- <script src="https://js.stripe.com/v3/"></script> --}}
{{-- <script>
trustedTypes.createPolicy('default', {
  createScriptURL: (input) => {
    if (new URL(input).origin === 'https://js.stripe.com') {
      return input;
    }
    return undefined;
  },
});
</script> --}}
{{-- <script src="{{ asset('frontend/js/stripe.js') }}"></script> --}}


  </head>
  <body>
  
  <div class="site-wrap">
    {{-- header start  --}}

    @include('frontend.body.header')
    {{-- header end --}}

 


    
    {{-- body start  --}}
<div id=main>

    @yield('main')
    
</div>
 {{-- body end --}}

 

{{-- footer start  --}}
@include('frontend.body.chatbot')
@include('frontend.body.footer')
{{-- footer end --}}
    
  </div>

  <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('frontend/js/aos.js') }}"></script>

  <script src="{{ asset('frontend/js/main.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('adminbackend/assets/js/code.js') }}"></script>
  <script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
  </script>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />



	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
     case 'info':
     toastr.info(" {{ Session::get('message') }} ");
     break;
   
     case 'success':
     toastr.success(" {{ Session::get('message') }} ");
     break;
   
     case 'warning':
     toastr.warning(" {{ Session::get('message') }} ");
     break;
   
     case 'error':
     toastr.error(" {{ Session::get('message') }} ");
     break; 
    }
    @endif 
   </script>



  <script type="text/javascript">
    $.ajaxSetup({
      headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    })

    // Add product to cart 
    function addToCart(){
      // get the data whanted to be passed to cart 
      var product_name = $('#pname').text();
      var id = $('#product_id').val();
      var vendor = $('#vproduct_id').val();
      var color = $('#color option:selected').text();
      var size = $('#size option:selected').text();
      var quantity = $('#qty').val();
      var length = $('#length').val();
      // add the data to cart 
      $.ajax({
        type: "POST",
        dataType: 'json',
        data:{
          color:color, size:size, quantity:quantity, length:length, product_name:product_name, vendor:vendor
        },
        url: "/cart/data/store/"+id,
        success:function(data){
          miniCart();
          // console.log(data)
          //display message
          const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            icon: 'success',
            title: 'Product Added To Cart Successfully',
            showConfirmButton: false,
            timer: 3000
        })
          if($.isEmptyObject(data.error)){
            Toast.fire({
              type: 'success',
              title: data.success,
            })
          }
          else{
            Toast.fire({
              type: 'error',
              title: data.error,
            })
          }
        }
      })
    }


  </script>



<script type="text/javascript">
    
  function miniCart(){
     $.ajax({
         type: "GET",
         url: "/product/mini/cart",
         dataType: 'json',
         success:function(response){
            //  console.log(response)
             // console.log(response)
             $('#cartQty').text(response.cartQty);
             $('#cartSubTotal').text(response.cartTotal + " BHD");
             
         var miniCart = ""
         $.each(response.carts, function(key,value){
          miniCart += 
          `<li>
                        <div class="mini-cart">
                        
                        <img class="p-2" style="height: 75px; width:75px;" src="/${value.options.image}">
                        <div class="pt-2 pr-3" style="display: block">
                        <h6>${value.name}</h6>
                        <p>${value.qty} X ${value.price} BHD</p>
                        </div>
                        <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)" class="btn primary-btn mt-3 ml-3"  style="height: 37px;"><p><i class="fa fa-trash"></i></p></button>
                        </div>
                      
          </li>
          <hr>`
        });

        $('#miniCart').html(miniCart);
      }
    })
  }
  miniCart();


  function miniCartRemove(rowId){
    $.ajax({
      type: "GET",
      url: "/minicart/product/remove/"+rowId,
      dataType: 'json',
      success:function(data){
      miniCart(); //to update without refresh

        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            
            // title: 'Product Deleted From Cart Successfully',
            showConfirmButton: false,
            timer: 3000
        })

          if($.isEmptyObject(data.error)){
            Toast.fire({
              type: 'success',
              icon: 'success',
              title: data.success,
            })
          }
          else{
            Toast.fire({
              type: 'error',
              icon: 'error',
              title: data.error,
            })
          }



      }
    })
  }
</script>



<script type="text/javascript">

//add wishlist functions
function addToWishlist(product_id){
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: "/add-to-wishlist/"+product_id,

    success:function(data){


      const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            
            showConfirmButton: false,
            timer: 5000
        })

          if($.isEmptyObject(data.error)){
            Toast.fire({
              type: 'success',
              icon: 'success',
              title: data.success,
            })
          }
          else{
            Toast.fire({
              type: 'error',
              icon: 'error',
              title: data.error,
            })
          }




    }
  })
}


//load wishlist data to the wishlist page
</script>

<script type="text/javascript">

  //add wishlist functions
  function wishlist(){
    $.ajax({
      type: "GET",
      dataType: 'json',
      url: "/get-all-wishlist-product",
  
      success:function(response){
        var $rows = ""
        $.each(response.wishlist, function(key, value){

          
          $rows += `
          <tr>
                  <td class="product-thumbnail">
                    <img src="/${value.product.product_thumbnail}" alt="Image" class="img-fluid">
                  </td>
                  <td class="product-name">
                    <h2 class="h5 text-black">${value.product.product_name}</h2>
                  </td>
                  <td>
                    ${value.product.discount_price == null || value.product.discount_price == 0 ? `${value.product.selling_price} BHD`: `${value.product.discount_price} BHD`}
                  </td>
                  <td>
                    ${value.product.product_qty > 0 && value.product.status == 1 ? ` <span class="badge badge-success">In Stock</span>`: `<span class="badge badge-danger">Out of Stock</span>`}
                  </td>

                  <td>
                    <a type="button" class="btn btn-sm text-light ">Add <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                  </td>

                  <td>
                    <a type="submit" id="${value.id}" onclick="wishlistProductRemove(this.id)" class="btn btn-sm" style="background-color: transparent;" ><i class="fa fa-trash"></i></a>

                  </td>
                  
                </tr>
          `
        });

        $('#wishlistData').html($rows);
        $('#wishlistQty').text(response.wishlistQty);
        $('#wishlistQtyTwo').text(response.wishlistQty);
  
  
      }
    })
  }
  wishlist();



  function wishlistProductRemove(id){
  $.ajax({
    type: "GET",
    dataType: 'json',
    url: "/wishlist-remove-product/"+id,

    success:function(data){
      wishlist(); //call the list wishlist method to return the current wishlist without refreshing


      const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            
            showConfirmButton: false,
            timer: 5000
        })

          if($.isEmptyObject(data.error)){
            Toast.fire({
              type: 'success',
              icon: 'success',
              title: data.success,
            })
          }
          else{
            Toast.fire({
              type: 'error',
              icon: 'error',
              title: data.error,
            })
          }




    }
  })
}
  </script>



{{-- load the cart to cart page --}}
<script type="text/javascript">
function cart(){
  $.ajax({
      type: "GET",
      url: "/get-cart-products",
      dataType: 'json',
      success:function(response){

          console.log(response)
          // console.log(response)
          $('#cartQtyTwo').text(response.cartQty);
          
      var rows = ""
      $.each(response.carts, function(key,value){
       rows += 
       `
       <tr>
                  <td class="product-thumbnail">
                    <img src="/${value.options.image}" alt="Image" class="img-fluid">
                  </td>
                  <td class="product-name">
                    <h2 class="h5 text-black">${value.name}</h2>
                  </td>
                  <td>${value.price} BHD</td>
                  <td>${value.options.color}</td>
                  <td>${value.options.size} ${value.options.length == null ? `` : ` <br> Legth: ${value.options.length}` }</td>
                  <td>
                    <div class="input-group mb-3" style="max-width: 120px;">
                      <div class="input-group-prepend">
                        <a id="${value.rowId}" onclick="cartQtyDecreament(this.id)" type="submit" class="btn btn-outline-primary js-btn-minus" >&minus;</a >
                      </div>
                      <input type="text" class="form-control text-center" value="${value.qty}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                      <div class="input-group-append">
                        <a id="${value.rowId}" onclick="cartQtyIncreament(this.id)" type="submit" class="btn btn-outline-primary js-btn-plus" >&plus;</a >
                      </div>
                    </div>

                  </td>
                  <td>${value.subtotal} BHD</td>
                  <td>
                    <a type="submit" id="${value.rowId}" onclick="cartProductRemove(this.id)"  class="btn btn-sm" style="background-color: transparent;" ><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
       `
     });

     $('#ViewCartProducts').html(rows);
   }
 })
}
cart();

function cartProductRemove(id){
  $.ajax({
    type: "GET",
    dataType: 'json',
    url: "/cart-remove-product/"+id,

    success:function(data){
      cart();
      miniCart();
      couponCalc();

      const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            
            showConfirmButton: false,
            timer: 5000
        })

          if($.isEmptyObject(data.error)){
            Toast.fire({
              type: 'success',
              icon: 'success',
              title: data.success,
            })
          }
          else{
            Toast.fire({
              type: 'error',
              icon: 'error',
              title: data.error,
            })
          }




    }
  })
}


function cartQtyDecreament(rowId){
  $.ajax({
    type: "GET",
    url: "/cart-qty-decreament/"+rowId,
    dataType: 'json',

    success:function(data){
      cart();
      miniCart();
      couponCalc();

    }
  })

}



function cartQtyIncreament(rowId){
  $.ajax({
    type: "GET",
    url: "/cart-qty-increament/"+rowId,
    dataType: 'json',
    success:function(data){
      cart();
      miniCart();
      couponCalc();

    }
  })

}


</script>
    
{{-- start apply coupon --}}
<script type="text/javascript">

  function applyCoupon(){
   
    var coupon_code = $('#coupon_code').val();
  $.ajax({
    type: "POST",
    datatype: 'json',
    data: {coupon_code:coupon_code},
    url: "/apply-coupon",

    success:function(data){
      couponCalc();
      if(data.validity == true){
        $('#couponField').hide();
        
      }
      const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            
            showConfirmButton: false,
            timer: 3000
        })

          if($.isEmptyObject(data.error)){
            Toast.fire({
              type: 'success',
              icon: 'success',
              title: data.success,
            })
          }
          else{
            Toast.fire({
              type: 'error',
              icon: 'error',
              title: data.error,
            })
          }
    }
  })
}



function couponCalc(){
  $.ajax({
    type: "GET",
    dataType: 'json',
    url: "/coupon-calc",

    success:function(data){

      if(data.total){
        $('#couponCalcField').html(
          `
          <div class="row mb-3">
                <div class="col-md-6">
                  <span class="text-black">Subtotal</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">${data.total} BHD</strong>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6">
                  <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">${data.total} BHD</strong>
                </div>
              </div>
          `
        )
      }
      else{

        $('#couponCalcField').html(
          `
          <div class="row mb-3">
                <div class="col-md-6">
                  <span class="text-black">Subtotal</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">${data.subtotal} BHD</strong>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <span class="text-black">Coupon Code</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">${data.coupon_code} <a type="submit" onclick="couponRemove()"> <i class="fa fa-trash"></i></a></strong>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <span class="text-black">Discount Amount</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">- ${data.discount_amount} BHD</strong>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6">
                  <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">${data.total_amount} BHD</strong>
                </div>
              </div>
          `
        )
        
      }

    }
  })

}
couponCalc();
</script>

<script type="text/javascript">
function couponRemove(){
  $.ajax({
    type: "GET",
    dataType: 'json',
    url: "/remove-coupon",

    success:function(data){

      
       $('#couponField').show();
       
       couponCalc();
      const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            
            showConfirmButton: false,
            timer: 5000
        })

          if($.isEmptyObject(data.error)){
            Toast.fire({
              type: 'success',
              icon: 'success',
              title: data.success,
            })
          }
          else{
            Toast.fire({
              type: 'error',
              icon: 'error',
              title: data.error,
            })
          }




    }
  })
}
</script>


  </body>
</html>