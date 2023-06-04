<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacementMail;

use App\Notifications\OrderPlaced;
use Illuminate\Support\Facades\Notification;


class StripeController extends Controller
{


    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
    }

    public function index()
    {
        return view('frontend.payment.payment_gateway');
    }

    public function payment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'fullName' => 'required',
                'cardNumber' => 'required',
                'month' => 'required',
                'year' => 'required',
                'cvv' => 'required'
            ]);

            if ($validator->fails()) {
                $request->session()->flash('danger', $validator->errors()->first());
                return response()->redirectTo('/');
            }

            $token = $this->createToken($request);
            if (!empty($token['error'])) {
                $request->session()->flash('danger', $token['error']);
                return response()->redirectTo('/');
            }
            if (empty($token['id'])) {
                $request->session()->flash('danger', 'Payment failed.');
                return response()->redirectTo('/');
            }

            $orderAmount = session()->get('order')['amount'] * 1000;
            $charge = $this->createCharge($token['id'], $orderAmount);
            // $charge = $this->createCharge($token['id'], 2000);
            if (!empty($charge) && $charge['status'] == 'succeeded') {


                // get user data to send nitification
                $notifiedUser = User::where('role', 'admin')->get();


                $request->session()->flash('success', 'Payment completed.');

                // when the payment succeeful 

                // record the order and the order details

                $order_id = Order::insertGetId([

                    'user_id' => Auth::user()->id,
                    'country_id' => $request->country_id,
                    'city_name' => $request->city_name,
                    'name' => $request->customer_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'postal_code' => $request->postal_code,
                    'order_note' => $request->order_note,

                    'payment_type' => $charge->payment_method,
                    'payment_method' => 'Stripe Gateway',
                    'transaction_id' => $charge->balance_transaction,
                    'currency' => $charge->currency,
                    'amount' => session()->get('order')['amount'],
                    'order_number' => $charge->metadata->order_id,

                    'invoice_number' => 'QMASHA' . mt_rand(10000000, 99999999),
                    'order_date' => Carbon::now()->format('d F Y'),
                    'order_month' => Carbon::now()->format('F'),
                    'order_year' => Carbon::now()->format('Y'),

                    'status' => 'pending',
                    'created_at' => Carbon::now(),

                ]);


                $products = Cart::content();
                foreach ($products as $product) {
                    OrderDetail::insert([
                        'order_id' => $order_id,
                        'product_id' => $product->id,
                        'vendor_id' => $product->options->vendor,
                        'color' => $product->options->color,
                        'size' => $product->options->size,
                        'length' => $product->options->length,
                        'qty' => $product->qty,
                        'price' => $product->price,
                        'status' => 'reviewing',
                        'created_at' => Carbon::now(),
                    ]);
                }

                $orderItems = OrderDetail::where('order_id', $order_id)->get();
                foreach ($orderItems as $item) {
                    $product = $item->product_id;
                    $qty = $item->qty;
                    //update the product qty 
                    Product::where('id', $product)->update([
                        'product_qty' => DB::raw('product_qty-' . $qty)
                    ]);
                }

                //send email successful opder placement 
                $invoice = Order::findOrFail($order_id);

                $data = [
                    'invoice_number' => $invoice->invoice_number,
                    'amount' => $invoice->amount,
                    'name' => $invoice->name,
                    'email' => $invoice->email,
                    'phone' => $invoice->phone,
                    'city_name' => $request->city_name,
                    'address' => $request->address,
                    'postal_code' => $request->postal_code,
                ];

                Mail::to($request->email)->send(new OrderPlacementMail($data));


                //clean the session variables 
                if (Session::has('coupon')) {
                    Session::forget('coupon');
                }
                Session::forget('order');
                //destroy the cart 
                Cart::destroy();

                $notification = array(
                    'message' => 'Your Order Placed Successfully :)',
                    'alert-type' => 'success'
                );

                // notification 
                Notification::send($notifiedUser, new OrderPlaced($request->name));

                return redirect()->route('thankYou')->with($notification);
            } else {

                $request->session()->flash('danger', 'Payment failed.');
                return response()->redirectTo('/');
            }
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {

        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                // 'currency' => 'usd',
                'currency' => 'BHD',
                'source' => $tokenId,
                'description' => 'Qmasha E-Commerce Shop - Oder Payment',
                'metadata' => ['order_id' => uniqid()]
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }

        return $charge;
    }


    public function CashPayment(Request $request)
    {
        try {

            // get user data to send nitification
            $notifiedUser = User::where('role', 'admin')->get();

            // record the order and the order details

            $order_id = Order::insertGetId([

                'user_id' => Auth::user()->id,
                'country_id' => $request->country_id,
                'city_name' => $request->city_name,
                'name' => $request->customer_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'order_note' => $request->order_note,

                'payment_type' => 'Cash On Delivery',
                'payment_method' => 'Cash On Delivery',

                'currency' => 'BHD',
                'amount' => session()->get('order')['amount'],

                'invoice_number' => 'QMASHA' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),

                'status' => 'pending',
                'created_at' => Carbon::now(),

            ]);


            $products = Cart::content();
            foreach ($products as $product) {
                OrderDetail::insert([
                    'order_id' => $order_id,
                    'product_id' => $product->id,
                    'vendor_id' => $product->options->vendor,
                    'color' => $product->options->color,
                    'size' => $product->options->size,
                    'length' => $product->options->length,
                    'qty' => $product->qty,
                    'price' => $product->price,
                    'status' => 'reviewing',
                    'created_at' => Carbon::now(),
                ]);
            }


            $orderItems = OrderDetail::where('order_id', $order_id)->get();
            foreach ($orderItems as $item) {
                $product = $item->product_id;
                $qty = $item->qty;
                //update the product qty 
                Product::where('id', $product)->update([
                    'product_qty' => DB::raw('product_qty-' . $qty)
                ]);
            }

            //send email successful opder placement 
            $invoice = Order::findOrFail($order_id);

            $data = [
                'invoice_number' => $invoice->invoice_number,
                'amount' => $invoice->amount,
                'name' => $invoice->name,
                'email' => $invoice->email,
                'phone' => $invoice->phone,
                'city_name' => $request->city_name,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
            ];

            Mail::to($request->email)->send(new OrderPlacementMail($data));

            //clean the session variables 
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            Session::forget('order');
            //destroy the cart 
            Cart::destroy();

            $notification = array(
                'message' => 'Your Order Placed Successfully :)',
                'alert-type' => 'success'
            );



            // notification 
            Notification::send($notifiedUser, new OrderPlaced($request->name));
            return redirect()->route('thankYou')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('thankYou')->with($notification);
    }

    public function SuccessfulOrder()
    {
        return view('frontend.payment.successful_order_placement');
    }
}
