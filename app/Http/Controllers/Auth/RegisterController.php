<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\College;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'registration_no'=>'required|string|max:10|min:10',
            'gender'=>'required|string|max:6',
            'college'=>'required|string',
            'department'=>'required|string',
            'course'=>'required|string',
            'mobile'=>'required|string|max:10|min:10',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function showRegistrationForm(){
        $colleges=College::select('college_name')->distinct()->get();
        return view('auth.register',compact('colleges'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'registration_no'=>$data['registration_no'],
            'gender'=>$data['gender'],
            'college'=>$data['college'],
            'department'=>$data['department'],
            'course'=>$data['course'],
            'mobile'=>$data['mobile'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
