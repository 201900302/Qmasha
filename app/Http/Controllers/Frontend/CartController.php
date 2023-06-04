<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Coupon;
use App\Models\shipCountry;
use Carbon\Carbon;
use Faker\Core\Number;
use Illuminate\Support\Facades\Facade;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //

    public function AddToCart(Request $request, $id)
    {
        //find the selected product 
        $product = Product::findOrFail($id);

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        if ($product->length_needed == 1) {

            if ($product->discount_price == NULL || $product->discount_price == 0) {

                Cart::add([
                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $product->selling_price,
                    'weight' => '1',
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'color' => $request->color,
                        'size' => $request->size,
                        'length' => $request->length,
                        'vendor' => $request->vendor,
                    ]
                ]);

                return response()->json(['success' => 'Product Successfully Added to Your Cart']);
            } elseif ($product->discount_price > 0) {
                Cart::add([
                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $product->discount_price,
                    'weight' => '1',
                    // 'length' =>$request->length, 
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'color' => $request->color,
                        'size' => $request->size,
                        'length' => $request->length,
                        'vendor' => $request->vendor,
                    ]
                ]);
                return response()->json(['success' => 'Product Successfully Added to Your Cart']);
            }
        }

        //if the length is not needed
        else if ($product->length_needed == 0) {

            if ($product->discount_price == NULL || $product->discount_price == 0) {

                Cart::add([
                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $product->selling_price,
                    'weight' => '1',
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'color' => $request->color,
                        'size' => $request->size,
                        'vendor' => $request->vendor,
                    ]
                ]);

                return response()->json(['success' => 'Product Successfully Added to Your Cart']);
            } elseif ($product->discount_price > 0) {
                Cart::add([
                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $product->discount_price,
                    'weight' => '1',
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'color' => $request->color,
                        'size' => $request->size,
                        'vendor' => $request->vendor,
                    ]
                ]);
                return response()->json(['success' => 'Product Successfully Added to Your Cart']);
            }
        } else {
            return response()->json(['danger' => 'Product add to cart Failed']);
        }
    }

    public function AddToMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal

        ));
    }



    public function RemoveFromMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Removed From Cart']);
    }

    public function myCart()
    {

        return view('frontend.cart.view_cart');
    }

    public function getAllCartProducts()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }

    public function RemoveCartProduct($rowId)
    {

        Cart::remove($rowId);
        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();
            Session::put('coupon', [
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * ($coupon->coupon_discount / 100)), 3,
                'total_amount' => round(Cart::total() - (Cart::total() * $coupon->coupon_discount / 100), 3),
            ]);
        }
        return response()->json(['success' => 'Product Successfully Removed From Your Cart']);
    }

    public function cartQtyDecreament($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();
            Session::put('coupon', [
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * ($coupon->coupon_discount / 100)), 3,
                'total_amount' => round(Cart::total() - (Cart::total() * $coupon->coupon_discount / 100), 3),
            ]);
        }

        return response()->json('Decreament');
    }

    public function cartQtyIncreament($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();
            Session::put('coupon', [
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * ($coupon->coupon_discount / 100), 3),
                'total_amount' => round(Cart::total() - (Cart::total() * $coupon->coupon_discount / 100), 3),
            ]);
        }
        return response()->json('Increament');
    }


    public function ApplyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->where('status', 1)->where('coupon_validity_date', ">=", Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            Session::put('coupon', [
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * ($coupon->coupon_discount / 100), 3),
                'total_amount' => round(Cart::total() - (Cart::total() * $coupon->coupon_discount / 100), 3),
            ]);


            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
        } else {
            return response()->json(array(
                'error' => 'Invalid Coupon'
            ));
        }
    }

    public function CouponCalc()
    {

        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_code' => session()->get('coupon')['coupon_code'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }


    public function RemoveCoupon()
    {
        //delete the coupon from the session 
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully']);
    }

    public function MakeCheckout()
    {


        //check if the user is logged in
        if (Auth::check()) {

            //check the cart has minimun 1 product 
            if (Cart::total() > 0) {

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                //to load the shipping countries
                $countries = shipCountry::orderBy('country_name', 'ASC')->where('status', 1)->get();

                return view('frontend.checkout.view_checkout', compact('carts', 'cartQty', 'cartTotal', 'countries'));
            }

            //if the cart is empty
            else {
                $notification = array(
                    'message' => 'Your Cart Is Empty',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        }

        //if the user is not logged in
        else {
            $notification = array(
                'message' => 'You Cannot Proceed To Checkout Without Log In! Please Log In ..',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }
    }
}
