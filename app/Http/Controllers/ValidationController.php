<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Page;
use Session;
use Illuminate\Support\Facades\DB;




use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SendEmailTest;
use App\Mail\MailNotify;
use App\Jobs\SendEmailJob;
use App\Jobs\SendEmails;

class ValidationController extends Controller
{
    //
    public function __construct(Page $user)
    {

       $this->userreg = $user;
    }



    public function formValdiation(){
        return view('form');
    }
    public function homePage(){
        return view('home');
    }
    public function loginPage(){
        return view('login');
    }
    public function forGot(){
        return view('forgot');
    }
    public function sentEmail(){
        return view('sentemail');
    }
    public function setpassword($email){
        $getEmail = $this->userreg->where('email',$email)->first();
        // dd($email);
        return view('newPassword',compact('getEmail'));
    }
    public function logOut(){
        Session::flush();
        return redirect('login');
    }
    public function validateForm(Request $request){
   
             try{
                $user['email'] = request()->get('email');

                // Must not already exist in the `email` column of `users` table
                $rules = array('email' => 'unique:userreg,email');
                $validator1 = Validator::make($user, $rules);
                if ($validator1->fails()) {
                    echo 'That email address is already registered. You sure you don\'t have an account?';
                    return redirect('/login')->with('success','Customer Added Successfully');
                    
                }
                else {
                    // Register the new user or whatever.
                
                $validator = Validator::make($request->all(), [
                    'name' => 'required|min:5|max:30',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:5|max:10',
                    'confirm_password' => 'required|min:5|max:10|same:password'
                    ],[
                        'name.required' => ' The first name field is required.',
                        'name.min' => ' The first name must be at least 5 characters.',
                        'name.max' => ' The first name may not be greater than 35 characters.',
                        'password.required' => ' The last name field is required.',
                        'password.min' => ' The last name must be at least 5 characters.',
                        'password.max' => ' The last name may not be greater than 35 characters.',
                    ]);
                    
                    }
                if ($validator->fails()) {
                    $error_messages = implode(',', $validator->messages()->all());
                    return back()->withInput()->withErrors($error_messages);
                }
                else{
                   
             
                    $this->userreg->create($request->all());
                    $details = new SendEmailJob($request->all());
                    dispatch($details);
                    toastr()->success('We sent you a email for successfully registered.Login here');
                    // Mail::to('aravindkumaranakr@gmail.com')->send(new SendEmailTest());
                    return redirect('/login')->with('success','Customer Added Successfully');
                   
                }
                
            }catch(Throwable $exception){
                return back()->with('error',$exception->getAllMessage());
            }
            
    }
    public function loginForm(Request $request){
       
        $this->validate($request,[
            'name' => 'required|min:5|max:30',

            'password' => 'required|min:5|max:10',

            ],[
                'name.required' => ' The first name field is required.',
                'name.min' => ' The first name must be at least 5 characters.',
                'name.max' => ' The first name may not be greater than 35 characters.',
                'password.required' => ' The last name field is required.',
                'password.min' => ' The last name must be at least 5 characters.',
                'password.max' => ' The last name may not be greater than 35 characters.',
            ]);
            
        $user = $this->userreg->where('name',$request->name)->where('password',$request->password)->first();

        if(isset($user)){
            Session::put('id',$user->id);
            Session::put('name',$user->name);
            toastr()->success('Login Success');
            return redirect('/home')->with('success','Login Successfully');
        }else{
            return back()->with('error','Invalid Login Credentials');
        }
        
            
       
}
    public function forgotPassword(Request $request){

    $user = $this->userreg->where('email',$request->email)->first();
    
    if(isset($user)){
        $detail = new SendEmails($request->all());
        // dd($detail);
        dispatch($detail);
        return redirect('/sent')->with('success','Login Successfully');
    }else{
        return back()->with('error','Invalid Login Credentials');
    }
}
    public function newPassword(Request $request){
        $this->validate($request,[
            

            'password' => 'required|min:5|max:10',
            'password1' => 'required|min:5|max:10|same:password'

            ],[
                
                'password.required' => ' The last name field is required.',
                'password.min' => ' The last name must be at least 5 characters.',
                'password.max' => ' The last name may not be greater than 35 characters.',
            ]);
            
        //    $password = $request->password;
        //    $foo = false;
        //    $id = $request->id;
        //    $page=Page::find($id);
        //    dd($password);
        // dd($request->email);
        $this->userreg->where('email',$request->email)->update(['password' => $request->password,'confirm_password'=> $request->password]);
        // $new = DB::table('userreg')->where('email',$request->email)->update(array('password' => $password,'confirm_password'=> $password));
        // dd($new);
            toastr()->success('Password resettes successfully you can login now with new password');
            return redirect('/login');
        
           
    }
}
