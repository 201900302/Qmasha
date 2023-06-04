<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;

class WishlistController extends Controller
{
    //

    public function AddToWishlist(Request $request, $product_id)
    {

        try {

            //check the user is logged in or no
            if (Auth::check()) {

                //cheack if the user already added the product to the wishlist previos
                $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

                //if the product soes not exists in the user`s wish list
                if (!$exists) {
                    //insert the product to the wishlist 
                    Wishlist::insert([
                        'user_id' => Auth::id(),
                        'product_id' => $product_id,
                        'created_at' => Carbon::now(),
                    ]);

                    return response()->json(['success' => 'Product Favourited and Successfully Added To Wishlist']);
                }

                //if the product exists in the wishlist 
                else {
                    return response()->json(['error' => 'This Product is Already Favourited']);
                }
            }

            //if the user is not logged in 
            else {
                return response()->json(['error' => 'You Are Not Able To Favoutire Product Without logging in']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function AllWishlistProducts()
    {
        return view('frontend.wishlist.view_wishlistProducts');
    }

    public function GetAllWishlistProducts()
    {

        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();

        $wishlistQty = count($wishlist);

        return response()->json(['wishlist' => $wishlist, 'wishlistQty' => $wishlistQty]);
    }


    public function RemoveWishlistProduct($id)
    {
        try {
            Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
            return response()->json(['success' => 'Product Successfully Removed From Wishlist']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
