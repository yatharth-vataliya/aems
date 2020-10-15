<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
    	return view('admin.login');
    }

    public function adminLogin(Request $request){
    	$request->validate([
    		'admin_username'=>'required|email|max:100',
    		'admin_password'=>'required|max:20'
    	]);

    	$admin=Admin::where('admin_username',$request->input('admin_username'))->first();
    	if($admin!=null){
    		if(Hash::check($request->input('admin_password'), $admin->admin_password)){
    			session(['is_admin'=>true]);
    			session(['admin_id'=>$admin->id]);
    			session(['admin_username'=>$admin->admin_username]);
                return redirect()->route('dashboard');
    		}else{
    			return back()->withErrors(['invalid'=>'sorry your credentials are invalid']);
    		}
    	}else{
    		return back()->withErrors(['invalid'=>'sorry your credentials are invalid']);
    	}
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function adminLogout(){
        session()->forget('is_admin');
        session()->forget('admin_id');
        session()->forget('admin_username');
        return redirect()->route('admin');
    }
}
