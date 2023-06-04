<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;



class AllUserController extends Controller
{
    //
    public function UserAccount(){
        $id= Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.account_details', compact('userData'));
    }

    public function UserChangePassword(){
        return view('frontend.dashboard.change_password');
    }
    public function UserOrders(){
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.dashboard.orders', compact('orders'));
    }

    public function UserOrderDetails($order_id){
        $order = Order::with('country','user')->where('id', $order_id)->where('user_id', Auth::user()->id)->first();
        $orderItems = OrderDetail::with('product', 'vendor')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('frontend.order.order_details', compact('order', 'orderItems'));

    }

    public function UserOrderDownlad($order_id){
        $order = Order::with('country','user')->where('id', $order_id)->where('user_id', Auth::user()->id)->first();
        $orderItems = OrderDetail::with('product', 'vendor')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $pdf = Pdf::loadView('frontend.order.order_download', compact('order', 'orderItems'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }


    public function UserOrderCancel($order_id){

        Order::findOrFail($order_id)->update([
            'status' => 'cancelled'
        ]);

        OrderDetail::where('order_id', $order_id)->update([
            'status' => 'cancelled'
        ]);

        
        $orderItems = OrderDetail::where('order_id', $order_id)->get();
            foreach($orderItems as $item){
            $product = $item->product_id;
            $qty = $item->qty;
            //update the product qty 
            Product::where('id',$product)->update([
            'product_qty' => DB::raw('product_qty+'.$qty)
        ]);

            }

        $notification = array(
            'message' => 'Order Cancelled Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }


    public function UserTrackOrder(){
        return view('frontend.dashboard.track_order');
    }

    public function UserTrackingOrder(Request $request){
        $invoiceNumber = $request->invoice;

        $track_order = Order::where('invoice_number', $invoiceNumber)->first();

        if($track_order){
            if($track_order->status == "cancelled"){
                $notification = array(
                    'message' => 'Cannot track cancelled order!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification); 
            }

            else{
                return view('frontend.order.track_order', compact('track_order'));
            }
            
        }
        else{
            $notification = array(
                'message' => 'Please inter valid invoice number!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification); 
        }

    }
}
