<?php

namespace App\Http\Controllers\Doctor;

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
use App\Models\Slot;

class DoctorController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('doctor');
    }

    public function index(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
        return view('doctor.dashboard',compact('unserInfo','SpecializeInfo'));
    }
	
	public function appointments(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
		return view('doctor.appointments',compact('unserInfo','SpecializeInfo'));
	}
	
	public function my_pateints(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();

		return view('doctor.my_pateints',compact('unserInfo','SpecializeInfo'));
	}
	
	public function schedule_timing(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
		$getSundaySlot     = Slot::where('user_id',$user_id)->where('slot_day','Sunday')->get();
		$getMondaySlot     = Slot::where('user_id',$user_id)->where('slot_day','Monday')->get();
		$getTuesdaySlot    = Slot::where('user_id',$user_id)->where('slot_day','Tuesday')->get();
		$getWednesdaySlot  = Slot::where('user_id',$user_id)->where('slot_day','Wednesday')->get();
		$getThursdaySlot   = Slot::where('user_id',$user_id)->where('slot_day','Thursday')->get();
		$getFridaySlot     = Slot::where('user_id',$user_id)->where('slot_day','Friday')->get();
		$getSaturdaySlot   = Slot::where('user_id',$user_id)->where('slot_day','Saturday')->get();
		$getCurrentDayName = date('l');
		
		return view('doctor.schedule_timing',compact('getSundaySlot','getMondaySlot','getTuesdaySlot','getWednesdaySlot','getThursdaySlot','getFridaySlot','getSaturdaySlot','unserInfo','SpecializeInfo','getCurrentDayName'));
	}
	
	public function add_new_slot(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
		return view('doctor.add_new_slot',compact('unserInfo','SpecializeInfo'));
	}
	
	public function add_new_slot_sction(Request $request){
		
		$request->validate([
            'time_duration_slot'  => ['required'],
            'slot_day'            => ['required'],
            'from_time'           => ['required'],
			'from_am_pm'          => ['required'],
			'to_time'             => ['required'],
			'to_am_pm'            => ['required'],
        ]);
		
		$slot = new Slot;
		$slot->time_duration_slot = $request->time_duration_slot;
		$slot->slot_day           = $request->slot_day;
		$slot->from_time          = $request->from_time;
		$slot->from_am_pm         = $request->from_am_pm;
		$slot->to_time            = $request->to_time;
		$slot->to_am_pm           = $request->to_am_pm;
		$slot->user_id            = Auth::user()->id;
		$slot->save();
		
        return redirect('/doctor/schedule-timing')->with('success', 'You have successfully added!');
	}
	
	public function slot_edit($slot_id){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		$SlotInfo        = Slot::where('id',$slot_id)->where('user_id',$user_id)->first();
		
		return view('doctor.edit_new_slot',compact('SlotInfo','unserInfo','SpecializeInfo'));
		
	}
	
	public function slot_edit_action(Request $request){
		
		$request->validate([
            'time_duration_slot'  => ['required'],
            'slot_day'            => ['required'],
            'from_time'           => ['required'],
			'from_am_pm'          => ['required'],
			'to_time'             => ['required'],
			'to_am_pm'            => ['required'],
			'status'              => ['required'],
        ]);
		
		$dataArray = array();
		$dataArray['time_duration_slot']    = $request->time_duration_slot;
		$dataArray['slot_day']     			= $request->slot_day;
		$dataArray['from_time']    			= $request->from_time;
		$dataArray['from_am_pm']   			= $request->from_am_pm;
		$dataArray['to_time']      			= $request->to_time;
		$dataArray['to_am_pm']     			= $request->to_am_pm;
		$dataArray['status']     			= $request->status;
		
		Slot::where('id',$request->slot_id)->where('user_id',Auth::user()->id)->update($dataArray);
        return redirect('/doctor/schedule-timing')->with('success', 'You have successfully updated!');

	}
	
	public function slot_delete($slot_id){
		
		Slot::where('id',$slot_id)->where('user_id',Auth::user()->id)->delete();
		return redirect('/doctor/schedule-timing')->with('success', 'You have successfully deleted!');
	}
	
	public function profile_setting(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		$featuresInfo    = Features::get();

		return view('doctor.profile_setting',compact('unserInfo','SpecializeInfo','featuresInfo'));
	}
	
	public function profile_setting_action(Request $request){
		
		$dataArray = array();
		$dataArray['name']                 = $request->first_name;
		$dataArray['last_name']            = $request->last_name;
		$dataArray['mobile_no']            = $request->mobile_no;
		$dataArray['gender']               = $request->gender;
		//$dataArray['dob']                  = $request->dob;
		$dataArray['about_me']             = $request->about_me;
		$dataArray['doctor_profile_name']  = $request->doctor_profile_name;
		$dataArray['specialist_id']        = $request->specialist_id;
		$dataArray['address']              = $request->address;
		$dataArray['city']                 = $request->city;
		$dataArray['state']                = $request->state;
		$dataArray['zip_code']             = $request->zip_code;
		$dataArray['country']              = $request->country;
		
		if(!empty($request->features_id)){
			$dataArray['features_id']     = implode(',',$request->features_id);
		}
		
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
        return redirect('/doctor/profile-setting')->with('success', 'You have successfully updated!');
	}
	
	public function change_password(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
		return view('doctor.change_password',compact('unserInfo','SpecializeInfo'));
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
