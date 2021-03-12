<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Page;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SendEmailTest;
use App\Mail\MailNotify;

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
    public function logOut(){
        Session::flush();
        return redirect('login');
    }
    public function validateForm(Request $request){
   
             try{
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
              
                if ($validator->fails()) {
                    $error_messages = implode(',', $validator->messages()->all());
                    return back()->withInput()->withErrors($error_messages);
                }
                else{
                   
                    $this->userreg->create($request->all());
                    $data = array('name'=>"Virat Gandhi");
   
                    Mail::send(['text'=>'email'], $data, function($message) {
                    $message->to('aravindkumaranakr@gmail.com', 'Tutorials Point')->subject
                    ('Laravel Basic Testing Mail');
                    $message->from('rubanshanthi24@gmail.com','Virat Gandhi');
                    });
                    echo "Basic Email Sent. Check your inbox.";
                    // Mail::to('aravindkumaranakr@gmail.com')->send(new SendEmailTest());
                    return redirect('/home')->with('success','Customer Added Successfully');
                 
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
            
            return redirect('/home')->with('success','Login Successfully');
        }else{
            return back()->with('error','Invalid Login Credentials');
        }
        
            
       
}
}
