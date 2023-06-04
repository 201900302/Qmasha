<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use App\Models\Order;
use App\Models\User;

class ReportController extends Controller
{
    //

    public function ReportView(){
        return view('Backend.report.report_view');
    }

    public function SearchByDate(Request $request){

        $from_date = new DateTime($request->from_date);
        $format_from_date = $from_date->format('d F Y');

        $to_date = new DateTime($request->to_date);
        $format_to_date = $to_date->format('d F Y');

        $orders = Order::whereBetween('order_date', [$format_from_date, $format_to_date])->latest()->get();

        return view('backend.report.report_by_date', compact('orders', 'format_from_date', 'format_to_date'));
    }


    public function SearchByMonth(Request $request){

        $month = $request->month;
       
        $year = $request->year_month;

        $orders = Order::where('order_month', $month)->where('order_year', $year)->latest()->get();

        return view('backend.report.report_by_month', compact('orders', 'month', 'year'));
    }


    public function SearchByYear(Request $request){

        
        $year = $request->year;

        $orders = Order::where('order_year', $year)->latest()->get();

        return view('backend.report.report_by_year', compact('orders', 'year'));
    }


    public function OrderByUser(){
        $users = User::where('role', 'user')->latest()->get();
        return view('backend.report.report_by_user', compact('users'));
    }

    public function SearchByUser(Request $request){


        $user_id = $request->user;
        $user_email = User::findOrFail($user_id)->email;
        // $user_email = User::select('email')->where('id', $user_id)->latest()->get();
        $orders = Order::where('user_id', $user_id)->latest()->get();

        return view('backend.report.show_report_by_user', compact('orders', 'user_id', 'user_email'));
    }



    public function GetAllUsers(){
        $users = User::where('role', 'user')->latest()->get();
        // $orders = Order::with('user')->where('id', $order_id)->first();

        return view('backend.report.report_all_user', compact('users'));
    }

    public function GetUserOrders($user_id){

        $user_email = User::findOrFail($user_id)->email;
        $orders = Order::where('user_id', $user_id)->latest()->get();

        return view('backend.report.show_report_by_user', compact('orders', 'user_id', 'user_email'));
    }

    public function GetAllVendors(){
        $users = User::where('role', 'vendor')->latest()->get();
        // $orders = Order::with('user')->where('id', $order_id)->first();

        return view('backend.report.report_all_vendor', compact('users'));
    }

    


    
}
