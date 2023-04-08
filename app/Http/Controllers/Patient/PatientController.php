<?php

namespace App\Http\Controllers\Patient;

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
use App\Models\Specialities;
use App\Models\Setting;

class PatientController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('patient');
    }

    public function index(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
        return view('patient.dashboard',compact('unserInfo','SpecializeInfo'));
    }
	
	public function profile_setting(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
		return view('patient.profile_setting',compact('unserInfo','SpecializeInfo'));
	}
	
	public function profile_setting_actions(Request $request){
		
		$dataArray = array();
		$dataArray['name']                 = $request->first_name;
		$dataArray['last_name']            = $request->last_name;
		$dataArray['mobile_no']            = $request->mobile_no;
		$dataArray['gender']               = $request->gender;
		$dataArray['address']              = $request->address;
		$dataArray['city']                 = $request->city;
		$dataArray['state']                = $request->state;
		$dataArray['zip_code']             = $request->zip_code;
		$dataArray['country']              = $request->country;
		
		if(isset($request->profile_pic)){
			
			$userInfo = User::where('id',Auth::user()->id)->first();
			if(!empty($userInfo->profile_pic)){
				$getFilePath = public_path('uploads/user/').$userInfo->profile_pic;
				if(file_exists($getFilePath)){
					unlink($getFilePath);
				}
			}
		    $imageName = time().'.'.$request->profile_pic->extension();  
            $request->profile_pic->move(public_path('uploads/user/'), $imageName);
			$dataArray['profile_pic']  = $imageName;
		}
		User::where('id',Auth::user()->id)->update($dataArray);
        return redirect('/patient/profile-setting')->with('success', 'You have successfully updated!');
	}
	
	public function change_password(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
		return view('patient.change_password',compact('unserInfo','SpecializeInfo'));
	}
	
	public function change_password_action(Request $request){
		
		$user         = Auth::user();
		$userPassword = $user->password;
		
		$request->validate([
            'old_password'     => 'required',
            'new_password'     => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);
		
		if (!Hash::check($request->old_password, $userPassword)) {
            return back()->withErrors(['old_password'=>'old password does not match']);
        }
		
		$user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success','password successfully updated');
	}
	
}
