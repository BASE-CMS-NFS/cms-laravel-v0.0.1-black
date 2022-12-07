<?php

namespace App\Http\Controllers;

#PACKAGE
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Validator;
use Hash;
#HELPER
use Cron;
use Date;
use Fibonanci;
use Helper;
use Nfs;
use Payments;
use Wa;
#MODEL
use App\Models\User;
use App\Models\Cms\Role;
use App\Models\Cms\CmsEmails;

use App\Mail\Emails;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email:rfc,dns|unique:users,email',
            'password'  => 'required',
            'phone'     => 'required|unique:users,phone',
        ]);

        $check_user = User::save_data($request); 

        if($check_user){
            Nfs::insertLogs('Register via web');

            return redirect('/login')->with('success','You have successfully registered, please login');
        }else{
            return back()->with('error','somethings else please try again');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|email:rfc,dns',
            'password'  => 'required',
        ]);

        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            #GET DATA USERS
            $user = User::where('email',$request->email)->first();
            if($user->status == 'active'){
                #CREATE NEW TOKEN
                $token_app=env('TOKEN_APP');
                $token = auth()->user()->createToken($token_app)->accessToken;
                $user = Auth::user();
                #ADD SESSION
                Session::put('name',$user->name);
                Session::put('phone',$user->phone);
                Session::put('email',$request->email);
                Session::put('token',$token);
                Session::put('id',$user->id);
                Session::put('cms_role_id',$user->cms_role_id);

                Nfs::insertLogs('login web');

                return redirect()->intended('dashboard');
            }elseif($user->status == 'notactive'){
                return back()->with('error','please check email to verification account');
            }else{
                return back()->with('error','your account suspend by admin, please contact admin to solve this problem');
            }
        }else{
            return back()->with('error','somethings else please try again');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forget_password(Request $request)
    {
        $request->validate([
            'email'     => 'required|email:rfc,dns',
        ]);

        // check users

        $check=User::where('email',$request->email)->first();

            if($check){

                $str = Str::random(6);

                $data['password'] = Hash::make($str);

                //update password
                $update=User::where('email',$request->email)->update($data);

                if($update){
                    //DATA TEMPLATE PASSWORD
                    $template = CmsEmails::where('slug','forgot_password')->first();
                    $setting  = [
                        "password"=>$str,
                        "email"   =>$request->email
                    ];

                    Mail::to($request->email)->send(new Emails($template,$setting));
                    return back()->with('success','success update password, please check email '.$request->email);
                    
                }else{
                    return back()->with('error','failed update password, please try again');

                }
            }else{
                return back()->with('error','email not found, please check again');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendEmail()
    {
        //
    }

    public function validasiEmail()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendOtp()
    {
        //
    }

    public function validasiOtp()
    {
        //
    }

    public function logout(Request $request)
    {
        Nfs::insertLogs('Logout via web');
        
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        Session::flush();
     
        return redirect('login')->with('success','Thanks !!!');
    }

}
