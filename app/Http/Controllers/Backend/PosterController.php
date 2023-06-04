<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\poster;
use Illuminate\Support\Facades\Auth;

use Exception;

class PosterController extends Controller
{
    //
    public function AllPoster()
    {
        $posters = Poster::latest()->get();
        return view('Backend.poster.poster_all', compact('posters'));
    }

    public function AddPoster()
    {
        return view('Backend.poster.poster_add');
    }

    public function StorePoster(Request $request)
    {

        try {

            $admin_id = Auth::user()->id;

            $posters = Poster::latest()->get();
            $posterCount = count($posters);

            if ($posterCount == 0) {

                Poster::insert([
                    'poster_title' => $request->poster_title,
                    'poster_body' => $request->poster_body,
                    'poster_url' => $request->poster_url,
                    'status' => 1,
                    'added_by' => $admin_id,
                    'created_at' => Carbon::now(),
                ]);
                $notification = array(
                    'message' => 'Annoucement Inserted and Activated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.poster')->with($notification);
            } else {
                Poster::insert([
                    'poster_title' => $request->poster_title,
                    'poster_body' => $request->poster_body,
                    'poster_url' => $request->poster_url,
                    'status' => 0,
                    'added_by' => $admin_id,
                    'created_at' => Carbon::now(),
                ]);
                $notification = array(
                    'message' => 'Annoucement Inserted Successfully',
                    'alert-type' => 'success'
                );
            }
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }

        return redirect()->route('all.poster')->with($notification);
    } // End Method 

    public function EditPoster($id)
    {
        $posters = Poster::findOrFail($id);
        return view('Backend.poster.poster_edit', compact('posters'));
    } // End Method 

    public function ViewPoster($id)
    {
        $posters = Poster::findOrFail($id);
        return view('Backend.poster.poster_view', compact('posters'));
    } // End Method 

    public function UpdatePoster(Request $request)
    {

        try {
            $poster_id = $request->id;
            Poster::findOrFail($poster_id)->update([
                'poster_title' => $request->poster_title,
                'poster_body' => $request->poster_body,
                'poster_url' => $request->poster_url,
                // 'status' => $request->status, 
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Annoucement Updated Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }

        return redirect()->route('all.poster')->with($notification);
    } // End Method 


    public function DeletePoster($id)
    {

        try {

            $posters = Poster::latest()->get();
            $posterCount = count($posters);

            $poster = Poster::findOrFail($id);
            if ($posterCount == 1) {

                $notification = array(
                    'message' => 'Annoucement Cannot Be Deleted, Becouse it is the only annoucement available',
                    'alert-type' => 'warning'
                );


                return redirect()->route('all.poster')->with($notification);
            } elseif ($poster->status == 1) {
                $notification = array(
                    'message' => 'Active Annoucement Cannot Be Deleted, Please activate other Annoucement, than delete the current Annoucement',
                    'alert-type' => 'warning'
                );

                return redirect()->route('all.poster')->with($notification);
            } else {



                Poster::findOrFail($id)->delete();

                $notification = array(
                    'message' => 'Annoucement Deleted Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
            }
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('all.poster')->with($notification);
        }
    } // End Method 

    public function PosterInactive($id)
    {

        try {

            $ActivePoster = Poster::where('status', 1)->get();
            $ActivePosterCount = count($ActivePoster);

            if ($ActivePosterCount == 1) {
                $notification = array(
                    'message' => 'You Cannot Inactive Annoucement Without Activing Another One! Please Activate an Annousement and this Annoucement will be automatically Inactived ',
                    'alert-type' => 'warning'
                );

                return redirect()->back()->with($notification);
            } else {
                Poster::findOrFail($id)->update([
                    'status' => 0,
                    'updated_at' => Carbon::now(),

                ]);
                $notification = array(
                    'message' => 'Annoucement Inactived Successfully',
                    'alert-type' => 'success'
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

    public function PosterActive($id)
    {

        try {

            Poster::where('status', 1)->update([
                'status' => 0,
                'updated_at' => Carbon::now(),
            ]);

            Poster::findOrFail($id)->update([
                'status' => 1,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Annoucement Activated Successfully',
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
}
