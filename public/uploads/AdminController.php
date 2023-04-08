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
use file;
use App\Models\User;
use App\Models\Features;

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

		$users = User::whereIn('role',array('doctor','patient','course'))->get();
        return view('admin.user.users',compact('users'));
    }
	
	public function add_user(){ 
        return view('admin.user.add_user');
    }
	
	public function add_user_action(Request $request){ 
        
		$request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
		
		User::create([
            'name'     => $request->name,
            'role'     => $request->role,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
		return redirect('/admin/users')->with('success', 'You have successfully added!');
    }
	
	public function edit_user($user_id){
		
		$userInfo = User::where('id',$user_id)->first();
        return view('admin.user.edit_user',compact('userInfo'));
    }
	
	public function edit_user_action(Request $request){
		
		$dataArray = array();
		$dataArray['name']  = $request->name;
		$dataArray['email'] = $request->email;
		$dataArray['role']  = $request->role;
		
		User::where('id',$request->user_id)->update($dataArray);
        return redirect('/admin/users')->with('success', 'You have successfully updated!');
    }
	
	public function delete_user($user_id){
		
		User::where('id',$user_id)->delete();
        return redirect('/admin/users')->with('success', 'You have successfully deleted!');
    }
	
	#FEATURES
	public function all_features(){
		
		$features = Features::get();
        return view('admin.features.features',compact('features'));
    }
	public function add_features(){ 
        return view('admin.features.add_feature');
    }
	
	public function add_feature_action(Request $request){
		
		$request->validate([
            'name'           => ['required', 'string', 'unique:features'],
            'feature_image'  => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
		if(isset($request->feature_image)){
		    $imageName = time().'.'.$request->feature_image->extension();  
            $request->feature_image->move(public_path('uploads/features/'), $imageName); 
			$data['image'] = $imageName;
		}
		//$data['name']  = $request->name;
		//$data['image'] = $request->file('feature_image')->getClientOriginalName();
		//$name = $request->file('feature_image')->getClientOriginalName();
       // $path = $request->file('feature_image')->store('public/uploads/features/');
		//Features::insert($data);

        return redirect('/admin/features')->with('success', 'You have successfully added!');
    }
}
