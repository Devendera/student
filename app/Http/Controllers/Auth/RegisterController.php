<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

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
            'name'      => ['required', 'string', 'max:255'],
            'address'   => ['required'],
            'dob'       => ['required'],
            'profile_picture'  => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {  
        if(isset($data['profile_picture'])){
		    $imageName = time().'.'.$data['profile_picture']->extension();  
            $data['profile_picture']->move(public_path('uploads/user/'), $imageName);
		}else{
            $imageName ='';
        }

        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'address'   => $data['address'],
            'profile_pic'   => $imageName,
            'dob'       => date('Y-m-d',strtotime($data['dob'])),
            'password'  => Hash::make($data['password']),
        ]);

    }
	
	protected function redirectTo(){   
	   
        if(Auth::user()->role == 'admin') {
            return 'admin/dashboard';
        }elseif(Auth::user()->role == 'student') {
			return '/';
        }else{
            return url()->previous();
        } 
    }
}
