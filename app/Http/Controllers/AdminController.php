<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Mail\BoutiqueApproveMail;
use App\Mail\BoutiqueRejectMail;
use Exception;

class AdminController extends Controller
{
    //


    public function AdminDashboard()
    {

        return view('admin.index');
    }


    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminDestroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }


    public function AdminProfile()
    {

        //get the logged in user id
        $id = Auth::user()->id;

        //get the user data
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }


    public function AdminProfileStore(Request $request)
    {

        try {

            $id = Auth::user()->id;
            $data = User::find($id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;

            //check if there is an image to change
            if ($request->file('photo')) {

                $file = $request->file('photo');
                @unlink(public_path('uploud/admin_images/' . $data->photo));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('uploud/admin_images'), $filename);
                $data['photo'] = $filename;
            }

            $data->save();

            //display notification
            $notification = array(
                'message' => 'Admin Profile Updated Successfully',
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


    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request)
    {

        try {
            //validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);


            //check the old password entered 

            //if the old passowrd entered is wrong
            if (!Hash::check($request->old_password, auth::user()->password)) {
                return back()->with("error", "Old Password Does Not Match!");
            }

            //update the password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return back()->with("status", "Password Changed Successfully!");
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return back()->with("status", $notification);
        }
    }



    public function InactiveBoutique()
    {
        $inActiveBoutique = User::where('role', 'vendor')->where('status', 'inactive')->latest()->get();
        return view('Backend.vendor.inactive_boutique', compact('inActiveBoutique'));
    } //end function 


    public function ActiveBoutique()
    {
        $activeBoutique = User::where('role', 'vendor')->where('status', 'active')->latest()->get();
        return view('Backend.vendor.active_boutique', compact('activeBoutique'));
    } //end function 

    public function RejectedBoutique()
    {
        $rejectedBoutique = User::where('role', 'vendor')->where('status', 'rejected')->latest()->get();
        return view('Backend.vendor.rejected_boutique', compact('rejectedBoutique'));
    } //end function 

    public function ViewBoutiqueDetails($id)
    {
        $vendorData = User::findOrFail($id);

        if ($vendorData->status == "inactive") {
            return view('backend.vendor.inactive_boutique_view', compact('vendorData'));
        } elseif ($vendorData->status == "active") {
            return view('backend.vendor.active_boutique_view', compact('vendorData'));
        } elseif ($vendorData->status == "rejected") {
            return view('backend.vendor.rejected_boutique_view', compact('vendorData'));
        }
    } // End Method 


    public function ActivateBoutiqueApprove(Request $request)
    {
        try {

            $vendor_id = $request->id;

            $user = User::findOrFail($vendor_id)->update([
                'status' => 'active',
            ]);

            //display notification
            $notification = array(
                'message' => 'Vendor id #' . $vendor_id . 'Has Been Activated Successfully',
                'alert-type' => 'success'
            );


            //send email to vendor(boutique)
            $email_receiver = User::findOrFail($vendor_id);
            $data = [
                'name' => $email_receiver->name,
                'boutiqueName' => $email_receiver->boutiqueName,
                'photo' => $email_receiver->photo,
                'email' => $email_receiver->email,
                'phone' => $email_receiver->phone,
                'vendor_join_date' => $email_receiver->vendor_join_date,
            ];

            Mail::to($email_receiver->email)->send(new BoutiqueApproveMail($data));

            return redirect()->route('active.boutique')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }



    // public function DeactivateBoutiqueApprove(Request $request){
    //     $vendor_id = $request->id;
    //     $user = User::findOrFail($vendor_id)->update([
    //         'status' => 'rejected',
    //     ]);

    //     //display notification
    //     $notification = array(
    //         'message' => 'Vendor id #'.$vendor_id.'Has Been Inactivated and Rejected Successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('rejected.boutique')->with($notification);

    // }



    public function RejectBoutiqueApprove(Request $request)
    {

        try {

            $vendor_id = $request->id;
            $user = User::findOrFail($vendor_id)->update([
                'status' => 'rejected',
            ]);

            //display notification
            $notification = array(
                'message' => 'Vendor id #' . $vendor_id . 'Has Been Rejected Successfully',
                'alert-type' => 'success'
            );


            //send email to vendor(boutique)
            $email_receiver = User::findOrFail($vendor_id);
            $data = [
                'name' => $email_receiver->name,
                'boutiqueName' => $email_receiver->boutiqueName,
                'photo' => $email_receiver->photo,
                'email' => $email_receiver->email,
                'phone' => $email_receiver->phone,
                'vendor_join_date' => $email_receiver->vendor_join_date,
            ];

            Mail::to($email_receiver->email)->send(new BoutiqueRejectMail($data));

            // return redirect()->route('rejected.boutique')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            // return back()->with($notification);
        }

        return redirect()->route('rejected.boutique')->with($notification);
    }


    // public function DeleteBoutiqueApprove(Request $request){

    //     $vendor_id = $request->id;
    //     $user = User::findOrFail($vendor_id)->delete();

    //     //display notification
    //     $notification = array(
    //         'message' => 'Vendor id #'.$vendor_id.'Has Been Deleted Successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->back()->with($notification);
    // }

    public function ReadNotification()
    {

        $user = Auth::user();

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}
