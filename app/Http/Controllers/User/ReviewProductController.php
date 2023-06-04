<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Carbon\Carbon;

use Exception;

class ReviewProductController extends Controller
{
    //

    public function StoreProductReview(Request $request)
    {

        try {

            $user_id = Auth::user()->id;

            $request->validate([
                'comment' => 'required',
                'rate' => 'required',
            ]);

            Review::insert([
                'user_id' => $user_id,
                'product_id' => $request->product_id,
                'vendor_id' =>  $request->vendor_id,
                'comment' => $request->comment,
                'rate' => $request->rate,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Review Added Successfully',
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

    public function GetAllPublishedReviews()
    {
        $reviews = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('backend.reviews.all_published_reviews', compact('reviews'));
    }

    public function GetAllBlockedReviews()
    {
        $reviews = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('backend.reviews.all_blocked_reviews', compact('reviews'));
    }


    public function BlockReview($review_id)
    {
        try {
            Review::findOrFail($review_id)->update([
                'status' => 0
            ]);
            $notification = array(
                'message' => 'Review Blocked Successfully',
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

    public function RePublishReview($review_id)
    {
        try {
            Review::findOrFail($review_id)->update([
                'status' => 1
            ]);
            $notification = array(
                'message' => 'Review Published Successfully',
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

    public function GetAllVendorReviews()
    {

        $reviews = Review::where('vendor_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('vendor.backend.reviews.all_vendor_reviews', compact('reviews'));
    }
}
