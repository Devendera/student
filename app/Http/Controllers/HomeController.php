<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        return view('home');
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
			'address'        => $request->address,
			'dob'            => date('Y-m-d',strtotime($request->dob)),
            'profile_pic'    => $imageName,
            'password'       => Hash::make($request->password),
        ]);
        
        #SEND MAIL     
        $name  = $request->name;
        $adminEmail = 'kdevender609@gmail.com'; 
        $email = $request->email;
        $subject = 'Verify Student Email';
        $url      = url('/user-verify').'/'.$email;
        $message = 'This is a new registration.. please verify.';

        Mail::send('mail', array('name' => $name, 'email' => $email, 'subject' => $subject, 'url' => $url,'message'=>$message), function($message) use ($name, $adminEmail, $subject)
        {
            $message->from('no-reply@gmail.com', 'Student');
            $message->to($adminEmail)->subject($subject);
        });
		return redirect('/admin/users')->with('success', 'You have successfully added!');
    }
    
    public function signIn(Request $request){
       
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
      
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
           $responseInfo =  User::where('email',$request->email)->first();
           if($responseInfo->status!=0) {
                if(Auth::attempt($credentials)) {
                    if(Auth::user()->role=='admin'){
                        return redirect('/admin/dashboard');
                    }else{
                       return redirect('/');
                    }
                }else{
                    return redirect()->back()->with('error', 'Sorry, your credential does not match!');
                   
                }
            }else{
                return redirect()->back()->with('error', 'Sorry, your verification is pending by administrator!');
            }
    }

    public function user_verify($email){
       
        $responseInfo =  User::where('email',$email)->first();
        if(!empty($responseInfo->email)) {
            if($responseInfo->status==0) {
                $responseInfo->status = 1;
                $responseInfo->save();
                return redirect('/login')->with('message', ' You have successfully verified!');
            }else{
                return redirect('/login')->with('error', 'You have allready verified!'); 
            }
        }else{
            dd('Some thing went wrong!...');
        }

    }

}
