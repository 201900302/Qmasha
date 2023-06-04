@extends('frontend.master_dashboard')
@section('main')

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Wishlist</strong></div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
        <div class="site-section-heading pt-3 mb-4">
            <h2 class="text-black">My Wishlist</h2>
            <p>There Are <span class="badge rounded-pill bg-secondary text-light" id="wishlistQtyTwo"></span> Products in Your Wishlist</p>
            </div>
        
      <div class="row mb-5">


          <div class="site-blocks-table">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="product-thumbnail">Image</th>
                  <th class="product-name">Product</th>
                  <th class="product-price">Price</th>
                  <th class="product-total">Availability</th>
                  <th class="product-quantity">Buy</th>
                  <th class="product-remove">Remove</th>
                </tr>
              </thead>
              <tbody id="wishlistData">
                


                
              </tbody>
            </table>
          </div>
        
      </div>

     
    </div>
  </div>

@endsection