<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Notifications\OrderItemPlaced;
use Illuminate\Support\Facades\Notification;

use Exception;

class OrderController extends Controller
{

    //
    public function AllOrder()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('backend.orders.all_orders', compact('orders'));
    }

    public function AllPendingOrder()
    {
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('backend.orders.all_pending_orders', compact('orders'));
    }

    public function AllConfirmedOrder()
    {
        $orders = Order::where('status', 'confirmed')->orderBy('id', 'DESC')->get();
        return view('backend.orders.all_confirmed_orders', compact('orders'));
    }

    public function AllProcessingOrder()
    {
        $orders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();
        return view('backend.orders.all_processing_orders', compact('orders'));
    }

    public function AllDeliveredOrder()
    {
        $orders = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();
        return view('backend.orders.all_delivered_orders', compact('orders'));
    }

    public function AllCancelledOrder()
    {
        $orders = Order::where('status', 'cancelled')->orderBy('id', 'DESC')->get();
        return view('backend.orders.all_cancelled_orders', compact('orders'));
    }

    public function AdminViewOrderDetails($order_id)
    {
        $order = Order::with('country', 'user')->where('id', $order_id)->first();
        $orderItems = OrderDetail::with('product', 'vendor')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.orders.view_order_details', compact('order', 'orderItems'));
    }


    public function PendingToConfirm($order_id)
    {
        try {


            //update the order status 
            Order::findOrFail($order_id)->update([
                'status' => 'confirmed',
                'confimed_date' => Carbon::now()->format('d F Y'),
            ]);
            //update the item status 
            OrderDetail::where('order_id', $order_id)->update([
                'status' => 'pending'
            ]);

            //notifiy the vendor
            $order = Order::where('id', $order_id)->first();
            $orderItems = OrderDetail::where('order_id', $order_id)->latest()->get();

            foreach ($orderItems as $orderItem) {
                $vendorId = $orderItem->vendor_id;
                $nofifiedVendor = User::where('id', $vendorId)->get();
                Notification::send($nofifiedVendor, new OrderItemPlaced($orderItem));
            }

            //display nofitication 
            $notification = array(
                'message' => 'Order Confirmed Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->route('confirmed.order')->with($notification);
    }

    public function ContirmToProcess($order_id)
    {

        try {

            //update the order status 
            Order::findOrFail($order_id)->update([
                'status' => 'processing',
                'processing_date' => Carbon::now()->format('d F Y'),
            ]);

            //display nofitication 
            $notification = array(
                'message' => 'Order Processing Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }

        return redirect()->route('processing.order')->with($notification);
    }

    public function ProceessToDeliverd($order_id)
    {

        try {

            //update the order status 
            $order_items = OrderDetail::where('order_id', $order_id)->get();

            $counter = 0;

            foreach ($order_items as $order_item) {
                if ($order_item->status != 'delivered') {
                    $counter = $counter + 1;
                }
            }

            if ($counter == 0) {
                Order::findOrFail($order_id)->update([
                    'status' => 'delivered',
                    'delivery_date' => Carbon::now()->format('d F Y'),
                ]);

                //display nofitication 
                $notification = array(
                    'message' => 'Order Delivered Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('delivered.order')->with($notification);
            } else {
                //display nofitication 
                $notification = array(
                    'message' => 'Order Items Are Not Ready For Delivery, Make Sure That All Order Items is Collected',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }


    public function AdminDownloadOrderDetails($order_id)
    {
        $order = Order::with('country', 'user')->where('id', $order_id)->first();
        $orderItems = OrderDetail::with('product', 'vendor')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $pdf = Pdf::loadView('frontend.order.order_download', compact('order', 'orderItems'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
}
