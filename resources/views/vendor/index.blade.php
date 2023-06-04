@extends('vendor.vendor_dashboard')

@section('vendor')
    
@php
    //take the auth id
    $id = Auth::user()->id;
    $vendorId = App\Models\User::findOrFail($id);
    $status = $vendorId->status;
@endphp

<!--start page wrapper -->
<div class="page-content">


    @if ($status == 'active')
    <h4>Vendor Account is <span class="text-success">Active</span></h4>

	@php
    
    $orderItemsToday = App\Models\OrderDetail::where('status', '!=' ,'cancelled')->where('created_at', Carbon\Carbon::now()->day)->where('vendor_id', Auth::user()->id)->latest()->get();
    $counter_day = 0;
    foreach ($orderItemsToday as $key => $item) {
        $countItem = $item->qty*$item->price;
        $counter_day = $counter_day + $countItem;
    }

    
    $orderItemsMonth = App\Models\OrderDetail::where('status', '!=' ,'cancelled')->whereMonth('created_at', Carbon\Carbon::now()->month)->where('vendor_id', Auth::user()->id)->latest()->get();
    $counter_month = 0;
    foreach ($orderItemsMonth as $key => $item) {
        $countItem = $item->qty*$item->price;
        $counter_month = $counter_month + $countItem;
    }


    
    $orderItemsYear = App\Models\OrderDetail::where('status', '!=' ,'cancelled')->whereYear('created_at', Carbon\Carbon::now()->year)->where('vendor_id', Auth::user()->id)->latest()->get();
    $counter_year = 0;
    foreach ($orderItemsYear as $key => $item) {
        $countItem = $item->qty*$item->price;
        $counter_year = $counter_year + $countItem;
    }


    $orderItemsTotal = App\Models\OrderDetail::where('status', '!=' ,'cancelled')->where('vendor_id', Auth::user()->id)->latest()->get();
    $counter_total = 0;
    foreach ($orderItemsTotal as $key => $item) {
        $countItem = $item->qty*$item->price;
        $counter_total = $counter_total + $countItem;
    }




    
    
    //////////////////////////

    $pending_order_items = count(App\Models\OrderDetail::where('vendor_id', Auth::user()->id)->where('status', 'pending')->latest()->get());
    $processing_order_items = count(App\Models\OrderDetail::where('vendor_id', Auth::user()->id)->where('status', 'processing')->latest()->get());
    $ready_order_items = count(App\Models\OrderDetail::where('vendor_id', Auth::user()->id)->where('status', 'ready')->latest()->get());
    $completed_order_items = count(App\Models\OrderDetail::where('vendor_id', Auth::user()->id)->where('status', 'delivered')->latest()->get());


    $customers=count(App\Models\User::where('role', 'user')->latest()->get());
@endphp

    <div class="pb-3 pt-3" >
        <h4>Sales Reporting Cards</h4>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    
    
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                 <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$counter_day}} BHD</h5>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-white'></i>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Today`s Sales</p>
                    </div>
                </div>
              </div>
            </div>
    
    
    
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$counter_month}} BHD</h5>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-white'></i>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Month Sales</p>
                    </div>
                </div>
              </div>
            </div>
    
    
    
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$counter_year}} BHD</h5>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-white'></i>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Year Sales</p>
                    </div>
                </div>
            </div>
            </div>
    
    
    
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$counter_total}} BHD</h5>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-white'></i>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Sales</p>
                    </div>
                </div>
            </div>
            </div>
    
    
        </div><!--end row-->
    
    
        <div class="pb-3 pt-3" >
            <h4>Orders Reporting Cards</h4>
        </div>
    
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    
    
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                 <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$pending_order_items}} Order Items</h5>
                        <div class="ms-auto">
                            <i class='bx bx-cart fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Pending Orders</p>
                    </div>
                </div>
              </div>
            </div>
    
    
    
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$processing_order_items}} Order Items</h5>
                        <div class="ms-auto">
                            <i class='bx bx-cart fs-3 text-white'></i>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Processing Orders</p>
                    </div>
                </div>
              </div>
            </div>
    
    
    
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$ready_order_items}} Order Items</h5>
                        <div class="ms-auto">
                            <i class='bx bx-cart fs-3 text-white'></i>
                        </div>
                    </div>
                
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Ready Orders</p>
                    </div>
                </div>
            </div>
            </div>
    
    
    
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                 <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$completed_order_items}} Order Items</h5>
                        <div class="ms-auto">
                            <i class='bx bx-cart fs-3 text-white'></i>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Completed Orders</p>
                    </div>
                </div>
             </div>
            </div>
    
    
        </div><!--end row-->

        <div class="pb-3 pt-3" >
            <h4>Your Boutique Page URL</h4>
            <div class="row">
                <div class="col-lg-10">
            <a href="{{route('boutique.details', Auth::user()->id)}}"><input id="url" type="text" class="form-control" value="{{route('boutique.details', Auth::user()->id)}}"></a>
                </div>
                <div class="col-lg-2">
            <button class="btn btn-warning" onclick="copyTextFunction()">Copy URL</button>
                </div>
            </div>
        </div>


      
       
    
        @elseif ($status == 'inactive')
        <h4>Vendor Account is <span class="text-warning">Inactive</span></h4>
        <p>Please wait until the admin check and approve your account .. Thank You</p>
        @elseif ($status == 'rejected')
        <h4>Vendor Account is <span class="text-danger">Rejected</span></h4>
        <p>Sorry, Your account has been rejected by the administration .. Thank You</p>
        @endif


   
</div>




    


     


    <!--end page wrapper -->
    {{-- <script  type="text/javascript">
        let text = document.getElementById('myText').innerHTML;
        const copyContent = async () => {
          try {
            await navigator.clipboard.writeText(text);
            console.log('Content copied to clipboard');
          } catch (err) {
            console.error('Failed to copy: ', err);
          }
        }
      </script> --}}


<script type="text/javascript">
function copyTextFunction() {
  // Get the text field
  var copyText = document.getElementById("url");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  alert("Your Boutique link copied");
}
</script>


    @endsection