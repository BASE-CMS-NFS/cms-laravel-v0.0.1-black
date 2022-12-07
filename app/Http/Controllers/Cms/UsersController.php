<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
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

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function init(){
        $data['link']='users';

        return $data;
    }

    public function index()
    {   
        $data                   = Self::init();
        $data['title'] = 'Management Users';
        
        if(Session::get('cms_role_id')==1){
            $data['data'] = User::join('cms_role','users.cms_role_id','=','cms_role.id')
                            ->select('users.*','cms_role.name as cms_role_name')->get();
        }else{
            $data['data'] = User::join('cms_role','users.cms_role_id','=','cms_role.id')
                            ->where('users.cms_role_id','!=',1)
                            ->select('users.*','cms_role.name as cms_role_name')
                            ->get();
        }
        
        return view('admin.cms.users.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data                   = Self::init();
        $data['title']   = 'Create Users';
        $data['subtitle']= 'this is the management users menu';
        $data['cms_role']= Role::where('id','!=',1)->get();
        return view('admin.cms.users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email:rfc,dns|unique:users,email',
            'password'  => 'required',
            'phone'     => 'required|unique:users,phone',
            'status'    => 'required',
            'cms_role_id'=> 'required',
        ]);

        $save = User::create(
            [
                'name'       =>$request->name,
                'email'      =>$request->email,
                'password'   =>Hash::make($request->password),
                'phone'      =>$request->phone,
                'status'     =>$request->status,
                'cms_role_id'=>$request->cms_role_id,
            
            ]
        );

        if($save){
            return redirect()->back()->with('message','success save data')->with('message_type','primary');
        }else{
            return redirect()->back()->with('message','failed save data')->with('message_type','warning');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data                   = Self::init();
        $data['title']   = 'Detail Users';
        $data['subtitle']= 'this is the management users menu';

        $users_id = Nfs::Decrypt($id);

        $data['cms_role']= Role::where('id','!=',1)->get();

        $data['users']    = User::join('cms_role','users.cms_role_id','=','cms_role.id')
                           ->where('users.id',$users_id)
                           ->select('users.*','cms_role.name as cms_role_name')
                           ->first();

        return view('admin.cms.users.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data                   = Self::init();
        $data['title']   = 'Edit Users';
        $data['subtitle']= 'this is the management users menu';

        $users_id = Nfs::Decrypt($id);

        $data['cms_role']= Role::where('id','!=',1)->get();

        $data['users']    = User::join('cms_role','users.cms_role_id','=','cms_role.id')
                           ->where('users.id',$users_id)
                           ->select('users.*','cms_role.name as cms_role_name')
                           ->first();

        return view('admin.cms.users.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id'        => 'required',
            'name'      => 'required|string',
            'email'     => 'required|email:rfc,dns',
            'phone'     => 'required',
            'status'    => 'required',
            'cms_role_id'=> 'required',
        ]);

        $users_id = Nfs::Decrypt($request->id);

        $fetch_one = User::where('id',$users_id)->first();

        if($request->email == $fetch_one->email){

            $request->validate([
                'email'     => 'required|email:rfc,dns',
            ]);

        }else{
            $request->validate([
                'email'     => 'required|email:rfc,dns|unique:users,email',
            ]);

        }

        if($request->phone == $fetch_one->phone){

            $request->validate([
                'phone'     => 'required',
            ]);

        }else{
            $request->validate([
                'phone'     => 'required|unique:users,phone',
            ]);

        }

        if($request->password == ''){
            $password = $fetch_one->password;
        }else{
            $password = Hash::make($request->password);
        }

        $update = User::where('id',$users_id)->update(
            [
                'name'       =>$request->name,
                'email'      =>$request->email,
                'password'   =>$password,
                'phone'      =>$request->phone,
                'status'     =>$request->status,
                'cms_role_id'=>$request->cms_role_id,
            
            ]
        );


        if($update){
            return redirect()->back()->with('message','success update data')->with('message_type','primary');
        }else{
            return redirect()->back()->with('message','failed update data')->with('message_type','warning');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
