<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use URL;
use App;
use DB;
use Auth;
use Illuminate\Support\Str;
use file;
use App\Models\User;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
        return view('admin.dashboard');
    }
	
	public function profile(){ 
        
		$profileInfo = Auth::user();
        return view('admin.profile',compact('profileInfo'));
    }
	
	public function update_profile(Request $request){
		
		$dataArray = array();
		
		$dataArray['name']  = $request->name;
		$dataArray['email'] = $request->email;
		
		User::where('id',Auth::user()->id)->where('role','admin')->update($dataArray);
		return redirect('/admin/profile')->with('success', 'Your profile has been updated successfully!');
	}
	
	public function all_users(){ 

		$users = User::whereIn('role',array('student'))->get();
        return view('admin.user.users',compact('users'));
    }
	
	public function add_user(){ 
        return view('admin.user.add_user');
    }
	
	public function add_user_action(Request $request){ 
        
		$request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
			'profile_picture'  => 'required|image|mimes:jpg,png,jpeg,gif,svg',
			'address'          => ['required'],
			'dob'              => ['required'],
        ]);
		
		if(isset($request->profile_picture)){
		    $imageName = time().'.'.$request->profile_picture->extension();  
            $request->profile_picture->move(public_path('uploads/user/'), $imageName);
		}
		
		User::create([
            'name'           => $request->name,
            'email'          => $request->email,
			'status'         => '1',
			'address'        => $request->address,
			'dob'            => date('Y-m-d',strtotime($request->dob)),
            'profile_pic'    => $imageName,
            'password'       => Hash::make($request->password),
        ]);
		return redirect('/admin/users')->with('success', 'You have successfully added!');
    }
	
	public function edit_user($user_id){
		
		$userInfo = User::where('id',$user_id)->first();
        return view('admin.user.edit_user',compact('userInfo'));
    }
	
	public function edit_user_action(Request $request){
		
		$dataArray = array();
		$dataArray['name']    = $request->name;
		$dataArray['email']   = $request->email;
		$dataArray['address'] = $request->address;
		$dataArray['dob']     = date('Y-m-d',strtotime($request->dob));
		$dataArray['status']  = $request->status;
		
		if(isset($request->profile_picture)){
			
			$userInfo = User::where('id',$request->user_id)->first();
			if(!empty($userInfo->profile_pic)){
				$getFilePath = public_path('uploads/features/').$userInfo->profile_pic;
				if(file_exists($getFilePath)){
					unlink($getFilePath);
				}
			}
		    $imageName = time().'.'.$request->profile_picture->extension();  
            $request->profile_picture->move(public_path('uploads/user/'), $imageName);
			$dataArray['profile_pic']  = $imageName;
		}

		User::where('id',$request->user_id)->update($dataArray);
        return redirect('/admin/users')->with('success', 'You have successfully updated!');
    }
	
	public function delete_user($user_id){
		
		$unserInfo = User::where('id',$user_id)->first();
		if(!empty($unserInfo->image)){
			$getFilePath = public_path('uploads/user/').$unserInfo->image;
			if(file_exists($getFilePath)){
				unlink($getFilePath);
			}
		}
		User::where('id',$user_id)->delete();
        return redirect('/admin/users')->with('success', 'You have successfully deleted!');
    }
}
