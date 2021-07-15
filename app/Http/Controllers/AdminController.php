<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class AdminController extends Controller
{
    public function index(){
        return view('admin-login');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function login(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;
        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if($result){
            Session::put('admin_name', $result->admin_name);
            Session::put('id', $result->id);
            return Redirect::to('/dashboard');
        }
        else
        {
            Session::put('message', 'Password or Email incorrect');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        Session::put('admin_name', null);
        Session::put('id', null);
        return Redirect::to('/admin');
    }
}
