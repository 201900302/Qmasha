<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Notifications\OrderItemReady;
use Illuminate\Support\Facades\Notification;

class OrderDetailsController extends Controller
{
    //

    public function AllVendorOrder()
    {
        $orderItems = OrderDetail::with('order')->where('vendor_id', Auth::user()->id)->where('status', '!=', 'reviewing')->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.all_orders', compact('orderItems'));
    }

    public function AllVendorPendingOrder()
    {
        $orderItems = OrderDetail::with('order')->where('vendor_id', Auth::user()->id)->where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.all_pending_orders', compact('orderItems'));
    }

    public function AllVendorProcessingOrder()
    {
        $orderItems = OrderDetail::with('order')->where('vendor_id', Auth::user()->id)->where('status', 'processing')->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.all_processing_orders', compact('orderItems'));
    }

    public function AllVendorFinishedOrder()
    {
        $orderItems = OrderDetail::with('order')->where('vendor_id', Auth::user()->id)->where('status', 'ready')->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.all_delivered_orders', compact('orderItems'));
    }

    public function AllVendorDeliveredOrder()
    {
        $orderItems = OrderDetail::with('order')->where('vendor_id', Auth::user()->id)->where('status', 'delivered')->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.all_delivered_orders', compact('orderItems'));
    }

    public function AllVendorCancelledOrder()
    {
        $orderItems = OrderDetail::with('order')->where('vendor_id', Auth::user()->id)->where('status', 'cancelled')->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.all_cancelled_orders', compact('orderItems'));
    }


    public function VendorOrderDetails($order_id)
    {
        $order = Order::with('country', 'user')->where('id', $order_id)->first();
        $orderItems = OrderDetail::with('product', 'vendor')->where('vendor_id', Auth::user()->id)->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.view_order_details', compact('order', 'orderItems'));
    }

    public function PendingToProcess($orderItem_id)
    {
        //update the order item status 
        OrderDetail::findOrFail($orderItem_id)->update([
            'status' => 'processing'
        ]);


        $item = OrderDetail::where('id', $orderItem_id)->first();
        $order_id = $item->order_id;


        //update the order status
        Order::findOrFail($order_id)->update([
            'status' => 'processing',
            'processing_date' => Carbon::now()->format('d F Y'),
        ]);

        //display nofitication 
        $notification = array(
            'message' => 'Order Item is Processing',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function ProcessToReady($orderItem_id)
    {
        //update the order item status 
        OrderDetail::findOrFail($orderItem_id)->update([
            'status' => 'ready'
        ]);
        //display nofitication 
        $notification = array(
            'message' => 'Order Item is Ready',
            'alert-type' => 'success'
        );


        //notify the admin
        $orderItem = OrderDetail::where('id', $orderItem_id)->first();
        $nofifiedAdmin = User::where('role', 'admin')->get();
        Notification::send($nofifiedAdmin, new OrderItemReady($orderItem));


        return redirect()->back()->with($notification);
    }
    public function ReadyToDeliverd($orderItem_id)
    {
        //update the order item status 
        OrderDetail::findOrFail($orderItem_id)->update([
            'status' => 'delivered'
        ]);
        //display nofitication 
        $notification = array(
            'message' => 'Order Item is Delivered',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminGetAllReadyItem()
    {
        $orderItems = OrderDetail::with('order')->where('status', 'ready')->orderBy('id', 'DESC')->get();
        return view('backend.orders.all_ready_order_items', compact('orderItems'));
    }
}
