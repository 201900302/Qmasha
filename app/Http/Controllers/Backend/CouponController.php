<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
use Exception;

class CouponController extends Controller
{
    //
    public function AllCoupon()
    {
        $coupons = Coupon::orderBy('coupon_validity_date', 'DESC')->latest()->get();
        return view('Backend.coupon.coupon_all', compact('coupons'));
    }

    public function AllActiveCoupon()
    {
        $coupons = Coupon::where('status', 1)->where('coupon_validity_date', ">=", Carbon::now()->format('Y-m-d'))->latest()->get();
        return view('Backend.coupon.coupon_active_all', compact('coupons'));
    }

    public function AllInactiveCoupon()
    {
        $coupons = Coupon::where('status', 0)->where('coupon_validity_date', ">=", Carbon::now()->format('Y-m-d'))->latest()->get();
        return view('Backend.coupon.coupon_inactive_all', compact('coupons'));
    }

    public function AllExpiredCoupon()
    {
        $coupons = Coupon::where('coupon_validity_date', "<", Carbon::now()->format('Y-m-d'))->latest()->get();
        return view('Backend.coupon.coupon_expired_all', compact('coupons'));
    }

    public function AddCoupon()
    {
        return view('Backend.coupon.coupon_add');
    }

    public function StoreCoupon(Request $request)
    {

        try {
            Coupon::insert([
                'coupon_code' => strtoupper($request->coupon_code),
                'coupon_discount' => $request->coupon_discount,
                'coupon_validity_date' => $request->coupon_validity_date,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Coupon Inserted and Activated Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->route('all.coupon')->with($notification);
    }

    public function InactiveCoupon($id)
    {

        try {
            Coupon::findOrFail($id)->update([
                'status' => 0,
            ]);
            $notification = array(
                'message' => 'Coupon Inactived Successfully',
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

    public function ActiveCoupon($id)
    {

        try {
            $coupon = Coupon::findOrFail($id);
            if ($coupon->coupon_validity_date < Carbon::now()->format('Y-m-d')) {
                $notification = array(
                    'message' => 'Expired Coupon Cannot Be Activated',
                    'alert-type' => 'danger'
                );
            } else {
                Coupon::findOrFail($id)->update([
                    'status' => 1,
                ]);
                $notification = array(
                    'message' => 'Coupon Activated Successfully',
                    'alert-type' => 'success'
                );
            }
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }


    public function EditCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit', compact('coupon'));
    }


    public function UpdateCoupon(Request $request)
    {

        try {
            $coupon_id = $request->id;

            Coupon::findOrFail($coupon_id)->update([
                'coupon_code' => strtoupper($request->coupon_code),
                'coupon_discount' => $request->coupon_discount,
                'coupon_validity_date' => $request->coupon_validity_date,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Coupon Updated Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }


        return redirect()->route('all.coupon')->with($notification);
    } // End Method 


    public function DeleteCoupon($id)
    {

        try {

            Coupon::findOrFail($id)->delete();

            $notification = array(
                'message' => 'Coupon Deleted Successfully',
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


    public function GetCouponPoster($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_poster', compact('coupon'));
    }
}
