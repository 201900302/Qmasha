<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

use Illuminate\Validation\Rules;
use Illuminate\View\View;

use Intervention\Image\Facades\Image;

use App\Notifications\BoutiqueRegistered;
use Illuminate\Support\Facades\Notification;

use Carbon\Carbon;

use Exception;

class VendorController extends Controller
{
    //

    public function VendorDashboard()
    {
        return view('vendor.index');
    }

    public function VendorLogin()
    {
        return view('vendor.vendor_login');
    }

    public function VendorDestroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }

    public function VendorProfile()
    {

        //get the logged in user id
        $id = Auth::user()->id;

        //get the user data
        $vendorData = User::find($id);
        return view('vendor.vendor_profile_view', compact('vendorData'));
    }

    public function VendorProfileStore(Request $request)
    {

        try {

            $id = Auth::user()->id;
            $data = User::find($id);
            $data->name = $request->name;
            $data->boutiqueName = $request->boutiqueName;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->vendor_join_date = $request->vendor_join_date;
            $data->vendor_description = $request->vendor_description;
            $data->account_URL = $request->account_URL;

            //check if there is an image to change
            if ($request->file('photo')) {

                $file = $request->file('photo');
                @unlink(public_path('uploud/vendor_images/' . $data->photo));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('uploud/vendor_images'), $filename);
                $data['photo'] = $filename;
            }

            $data->save();

            //display notification
            $notification = array(
                'message' => 'Vendor Profile Updated Successfully',
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

    public function VendorChangePassword()
    {
        return view('vendor.vendor_change_password');
    }

    public function VendorUpdatePassword(Request $request)
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



    public function RegisterBoutique()
    {
        return view('auth.register_boutique');
    } //end vendor register method 


    public function VendorRegister(Request $request)
    {

        try {
            // get user data of the nitification receiver
            $notifiedUser = User::where('role', 'admin')->get();


            $current_date = date('Y-m-d H:i:s');

            $file = $request->file('logo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            Image::make($file)->resize(300, 300)->save('uploud/vendor_images/' . $filename);
            $save_url = 'uploud/vendor_images/' . $filename;


            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'min:9', 'unique:' . User::class],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'boutiqueName' => $request->boutiqueName,
                'photo' => $filename,
                'vendor_description' => $request->vendor_description,
                'account_url' => $request->account_url,
                'vendor_join_date' => Carbon::now()->format('d F Y'),
                'role' => 'vendor',
                'status' => 'inactive',

            ]);

            $notification = array(
                'message' => 'Vendor Registered Successfully',
                'alert-type' => 'success'
            );


            //notify the admins
            // notification 
            Notification::send($notifiedUser, new BoutiqueRegistered($request));
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }

        return redirect()->route('vendor.login')->with($notification);
    }


    public function ReadNotification()
    {

        $user = Auth::user();

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }

    public function VendorPostPage()
    {
        return view('vendor.joining_post');
    }
}
