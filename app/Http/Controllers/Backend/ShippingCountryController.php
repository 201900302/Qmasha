<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\shipCountry;
use Carbon\Carbon;

use Exception;

class ShippingCountryController extends Controller
{
    //
    public function AllShippingArea()
    {
        $shippingAreas = shipCountry::orderBy('id', 'DESC')->get();
        return view('Backend.shippingArea.shippingArea_all', compact('shippingAreas'));
    }

    public function AllActiveShippingArea()
    {
        $shippingAreas = shipCountry::where('status', 1)->latest()->get();
        return view('Backend.shippingArea.shippingArea_active_all', compact('shippingAreas'));
    }

    public function AllInactiveShippingArea()
    {
        $shippingAreas = shipCountry::where('status', 0)->latest()->get();
        return view('Backend.shippingArea.shippingArea_inactive_all', compact('shippingAreas'));
    }


    public function AddShippingArea()
    {
        return view('Backend.shippingArea.shippingArea_add');
    }

    public function StoreShippingArea(Request $request)
    {

        try {
            shipCountry::insert([
                'country_name' => $request->country_name,
                'shipping_cost' => $request->shipping_cost,
                'country_cities' => $request->country_cities,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Shipping Area Inserted and Activated Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->route('all.shippingArea')->with($notification);
    }

    public function InactiveShippingArea($id)
    {

        try {
            shipCountry::findOrFail($id)->update([
                'status' => 0,
            ]);
            $notification = array(
                'message' => 'Shipping Area Inactived Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function ActiveShippingArea($id)
    {

        try {
            shipCountry::findOrFail($id)->update([
                'status' => 1,
            ]);
            $notification = array(
                'message' => 'Shipping Area Actived Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }


    public function EditShippingArea($id)
    {
        $shippingArea = shipCountry::findOrFail($id);
        return view('backend.shippingArea.shippingArea_edit', compact('shippingArea'));
    }


    public function UpdateShippingArea(Request $request)
    {

        try {

            $shippingArea_id = $request->id;

            shipCountry::findOrFail($shippingArea_id)->update([
                'country_name' => $request->country_name,
                'shipping_cost' => $request->shipping_cost,
                'country_cities' => $request->country_cities,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Shipping Area Updated Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }

        return redirect()->route('all.shippingArea')->with($notification);
    } // End Method 


    public function DeleteShippingArea($id)
    {

        try {

            shipCountry::findOrFail($id)->delete();

            $notification = array(
                'message' => 'Shipping Area Deleted Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    } // End Method 
}
