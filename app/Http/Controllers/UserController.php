<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Exception;

class UserController extends Controller
{
    //

    public function UserDashboard()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('index', compact('userData'));
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function UserDestroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //display notification
        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );


        return redirect('/login')->with($notification);
    }


    public function AdminProfile()
    {

        //get the logged in user id
        $id = Auth::user()->id;

        //get the user data
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }


    public function UserProfileStore(Request $request)
    {

        try {

            $id = Auth::user()->id;
            $data = User::find($id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;

            //check if there is an image to change
            // if($request->file('photo')){

            //     $file = $request->file('photo');
            //     @unlink(public_path('uploud/admin_images/'.$data->photo));
            //     $filename = date('YmdHi').$file->getClientOriginalName();
            //     $file->move(public_path('uploud/admin_images'),$filename);
            //     $data['photo'] = $filename;
            // }

            $data->save();

            //display notification
            $notification = array(
                'message' => 'User Profile Updated Successfully',
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

    public function UserUpdatePassword(Request $request)
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
            return back()->with("status", $e->getMessage());
        }
    }
}
