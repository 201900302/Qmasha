<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: white
    }
    .font{
      font-size: 15px;
    }
    .authority {
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: #926F34;
        margin-left: 35px;
    }
    .thanks p {
        color: #926F34;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
           <img src="{{ public_path('images/logoTransparent.png') }}" alt="" width="200"/>
        </td>
        <td align="right">
            <pre class="font" >
               Qmasha E-commerce Company
               Email:qmasha.ecommerce@gmail.com <br>
               Bahrain, Manama <br>
              
            </pre>
        </td>
    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Name:</strong> {{$order->name}} <br>
           <strong>Email:</strong> {{$order->email}} <br>
           <strong>Phone:</strong> {{$order->phone}} <br>
           <strong>Ship to:</strong> {{$order['country']['country_name']}}, {{$order->city_name}} <br>
           <strong>Address:</strong> {{$order->address}} <br>
           <strong>Post Code:</strong> {{$order->postal_code}}
         </p>
        </td>
        <td>
          <p class="font">
            <h3><span style="color: #926F34;">Invoice:</span>{{$order->invoice_number}}</h3>
            Order Date: {{$order->order_date}} <br>
            Payment Type : {{$order->payment_method}}</span>
         </p>
        </td>
    </tr>
  </table>
  <br/>
<h3>Products</h3>


  <table width="100%">
    <thead style="background-color: #DFBD69; color:#FFFFFF;">
      <tr class="font">
        <th>Image</th>
        <th>Product Name</th>
        <th>Boutique Name</th>
        <th>Size</th>
        <th>Color</th>
        <th>Quantity</th>
        <th>Unit Price </th>
      </tr>
    </thead>
    <tbody>

     @foreach ($orderItems as $orderItem)
         
      <tr class="font">
        <td align="center">
            <img src="{{ public_path($orderItem->product->product_thumbnail)}}" style="height: 60px; width:60px;">
        </td>
       
        <td align="center">{{$orderItem['product']['product_name']}}</td>
        <td align="center"> {{$orderItem['vendor']['boutiqueName']}}</td>
        <td align="center">{{$orderItem->size}}
            @if ($orderItem->length == null)
            @else
            / length: {{$orderItem->length}}    
           @endif
        </td>
        <td align="center">{{$orderItem->color}}</td>
        <td align="center">{{$orderItem->qty}}</td>
        <td align="center">{{$orderItem->price}} BHD</td>
      </tr>

      @endforeach
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><span style="color: #926F34;">Total With Delivery:</span>{{$order->amount}} BHD</h2>
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <p>Thanks For Buying From Qmasha</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>