<?php

namespace App\Http\Controllers\Trainer;

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
use App\Models\Course;
use App\Models\Coursecontent;

class TrainerController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('trainer');
    }

    public function index(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
        return view('trainer.dashboard',compact('unserInfo','SpecializeInfo'));
    }
	
	#PROFILE SETTING
	public function profile_setting(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
		return view('trainer.profile_setting',compact('unserInfo','SpecializeInfo'));
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
        return redirect('/trainer/profile-setting')->with('success', 'You have successfully updated!');
	}
	
	#CHANGE PASSWORD
	public function change_password(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$SpecializeInfo  = Specialities::get();
		
		return view('trainer.change_password',compact('unserInfo','SpecializeInfo'));
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
	
	#COURSE
	public function get_course(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$courseInfo      = Course::where('user_id',$user_id)->get();
		
		return view('trainer.courses',compact('unserInfo','courseInfo'));
	}
	
	public function add_new_course(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		
		return view('trainer.add_new_course',compact('unserInfo'));
	}
	
	public function add_new_course_action(Request $request){
		
		$request->validate([
            'name'           => ['required', 'unique:course'],
            'description'    => ['required'],
            'course_image'   => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
		
		$course = new Course;
		$course->name         = $request->name;
		$course->user_id      = Auth::user()->id;
		$course->description  = $request->description;
		
		if(isset($request->course_image)){
		    $imageName = time().'.'.$request->course_image->extension();  
            $request->course_image->move(public_path('uploads/course/'), $imageName); 
			$course->image = $imageName; 
		}
		$course->save();
		
        return redirect('/trainer/course')->with('success', 'You have successfully added!');
	}
	
	public function edit_course($course_id){

		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$courseInfo      = Course::where('user_id',$user_id)->where('id',$course_id)->first();
		
		return view('trainer.edit_course',compact('unserInfo','courseInfo'));
	}
	
	public function edit_course_action(Request $request){
		
		$dataArray = array();
		$dataArray['name']         = $request->name;
		$dataArray['status']       = $request->status;
		$dataArray['description']  = $request->description;
		
		if(isset($request->course_image)){
			
			$courseInfo = Course::where('user_id',Auth::user()->id)->where('id',$request->course_id)->first();
			if(!empty($courseInfo->image)){
				$getFilePath = public_path('uploads/course/').$courseInfo->image;
				if(file_exists($getFilePath)){
					unlink($getFilePath);
				}
			}
		    $imageName = time().'.'.$request->course_image->extension();  
            $request->course_image->move(public_path('uploads/course/'), $imageName); 
			$dataArray['image'] = $imageName; 
		}
		
		Course::where('user_id',Auth::user()->id)->where('id',$request->course_id)->update($dataArray);
        return redirect('/trainer/course')->with('success', 'You have successfully updated!');
	}
	
	public function delete_course($course_id){
		
		$courseInfo = Course::where('user_id',Auth::user()->id)->where('id',$course_id)->first();
		if(!empty($courseInfo->image)){
			$getFilePath = public_path('uploads/course/').$courseInfo->image;
			if(file_exists($getFilePath)){
				unlink($getFilePath);
			}
		}
		Course::where('user_id',Auth::user()->id)->where('id',$course_id)->delete();
		return redirect('/trainer/course')->with('success', 'You have successfully deleted!');
	}
	
	#COURSE CONTENT
	public function get_course_content(){
		
		$user_id             = Auth::user()->id;
		$unserInfo           = User::where('id',$user_id)->first();
		$coursecontentInfo   = Coursecontent::select('course_content.*','users.name as user_name','course.name as course_name')->join('users','users.id','=','course_content.user_id')->join('course','course.id','=','course_content.course_id')->where('course_content.user_id',$user_id)->get();
		
		return view('trainer.course_content',compact('unserInfo','coursecontentInfo'));
	}
	 
	public function add_course_content(){
		
		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$courseInfo      = Course::where('user_id',$user_id)->get();
		
		return view('trainer.add_course_content',compact('unserInfo','courseInfo'));
	}
	
	public function add_course_content_action(Request $request){
		
		$request->validate([
            'course_id'      => ['required'],
            'pdf_link'       => ['required'],
            'zoom_link'      => ['required'],
            'description'    => ['required'],
			'video'          => ['mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040|required'],
        ]);
		
		$coursecontent = new Coursecontent;
		$coursecontent->course_id     = $request->course_id;
		$coursecontent->pdf_link      = $request->pdf_link;
		$coursecontent->zoom_link     = $request->zoom_link;
		$coursecontent->user_id       = Auth::user()->id;
		$coursecontent->description   = $request->description;
		
		if(isset($request->video)){
		    $imageName = time().'.'.$request->video->extension();  
            $request->video->move(public_path('uploads/course_content/'), $imageName); 
			$coursecontent->video = $imageName; 
		}
		$coursecontent->save();
		
        return redirect('/trainer/course-content')->with('success', 'You have successfully added!');
	}
	
	public function edit_course_content($course_id){

		$user_id         = Auth::user()->id;
		$unserInfo       = User::where('id',$user_id)->first();
		$courseInfo      = Course::where('user_id',$user_id)->where('id',$course_id)->first();
		
		return view('trainer.edit_course',compact('unserInfo','courseInfo'));
	}
	
	public function edit_course_content_action(Request $request){
		
		$dataArray = array();
		$dataArray['name']         = $request->name;
		$dataArray['status']       = $request->status;
		$dataArray['description']  = $request->description;
		
		if(isset($request->course_image)){
			
			$courseInfo = Course::where('user_id',Auth::user()->id)->where('id',$request->course_id)->first();
			if(!empty($courseInfo->image)){
				$getFilePath = public_path('uploads/course/').$courseInfo->image;
				if(file_exists($getFilePath)){
					unlink($getFilePath);
				}
			}
		    $imageName = time().'.'.$request->course_image->extension();  
            $request->course_image->move(public_path('uploads/course/'), $imageName); 
			$dataArray['image'] = $imageName; 
		}
		
		Course::where('user_id',Auth::user()->id)->where('id',$request->course_id)->update($dataArray);
        return redirect('/trainer/course')->with('success', 'You have successfully updated!');
	}
	
	public function delete_course_content($course_id){
		
		$courseInfo = Course::where('user_id',Auth::user()->id)->where('id',$course_id)->first();
		if(!empty($courseInfo->image)){
			$getFilePath = public_path('uploads/course/').$courseInfo->image;
			if(file_exists($getFilePath)){
				unlink($getFilePath);
			}
		}
		Course::where('user_id',Auth::user()->id)->where('id',$course_id)->delete();
		return redirect('/trainer/course')->with('success', 'You have successfully deleted!');
	}
}
