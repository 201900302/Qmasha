<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\shipCountry;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    //

    public function CityGetAjax($country_id)
    {
        $ship = shipCountry::where('id', $country_id)->first();
        $country_cities = $ship->country_cities;
        $city = explode(',', $country_cities);
        return json_encode($city);
    }

    public function CostGetAjax($country_id)
    {
        $ship = shipCountry::where('id', $country_id)->first();
        $cost = $ship->shipping_cost;

        return response()->json(array(
            'cost' => $cost
        ));
    }


    public function StoreCheckout(Request $request)
    {

        // $orderTotalAmount = " ";
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['country_id'] = $request->country_id;
        $data['city_name'] = $request->city_name;
        $data['customer_address'] = $request->customer_address;
        $data['customer_postal_zip'] = $request->customer_postal_zip;
        $data['customer_order_notes'] = $request->customer_order_notes;
        // $data['orderTotal'] = Cart::total();
        $cartTotalAmount = Cart::total();

        $shippingCountry = shipCountry::where('id', $request->country_id)->first();
        $shippingCost = $shippingCountry->shipping_cost;


        if (Session::has('coupon')) {
            if ($request->payment_method == 'stripeGateway') {
                $orderTotalAmount = session()->get('coupon')['total_amount'] + $shippingCost;
            } elseif ($request->payment_method == 'cashOnDelivery') {
                $orderTotalAmount = session()->get('coupon')['total_amount'] + $shippingCost + 4;
            }
        } else {
            if ($request->payment_method == 'stripeGateway') {
                $orderTotalAmount = $cartTotalAmount + $shippingCost;
            } elseif ($request->payment_method == 'cashOnDelivery') {
                $orderTotalAmount = $cartTotalAmount + $shippingCost + 4;
            }
        }

        Session::put('order', [
            'amount' => $orderTotalAmount
        ]);

        $data['payment_method'] = $request->payment_method;

        if ($request->payment_method == 'stripeGateway') {
            return view('frontend.payment.payment_geteway', compact('data', 'cartTotalAmount', 'shippingCost', 'orderTotalAmount'));
        } elseif ($request->payment_method == 'cashOnDelivery') {
            return view('frontend.payment.payment_cashOnDelivery', compact('data', 'cartTotalAmount', 'shippingCost', 'orderTotalAmount'));
        }
    }
}
