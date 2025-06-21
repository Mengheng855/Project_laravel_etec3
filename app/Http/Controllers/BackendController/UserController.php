<?php

namespace App\Http\Controllers\BackendController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function login(){
        return view('backend.login');
    }
    public function register(){
        return view('backend.register');
    }
    public function signupSubmit(Request $request){
        $input=$request->validate([
            'name'=>'required|min:5',
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
        if(($request->hasFile('profile'))){
            $file=$request->file('profile');
            $filename=date('ymdhis').'_'.$file->getClientOriginalName();
            $file->move('images',$filename);
            $input['profile']=url('images/'.$filename);
        }
        $input['password']=Hash::make($request->password);
        $signUp=User::create($input);
        if($signUp){
            return redirect('/login');
        }
    }
    public function loginSubmit(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if (Auth::attempt(['email' => $email,'password'=>$password])) {
            if(Auth::user()->is_admin){
                return redirect()->route('dashBoard');
            }else{
                return redirect('/');
            }
        }
        return 'Error';
    }
    public function dashBoard(){
        if(Auth::user()->is_admin){
            return view('backend.master');
        }else{
            return redirect('/');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
