<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
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

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function init(){
        $data['link']='cms_role';

        return $data;
    }

    public function index()
    {
        $data                   = Self::init();
        $data['title'] = 'Management Role';
        
        if(Session::get('cms_role_id')==1){
            $data['data'] = Role::all();
        }else{
            $data['data'] = Role::where('id','!=',1)->get();
        }
        
        return view('admin.cms.role.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data                   = Self::init();
        $data['title']   = 'Create Role';
        $data['subtitle']= 'this is the management roles menu';
        return view('admin.cms.role.create',$data);
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
            'name'      => 'required|string|unique:cms_role,name',
        ]);

        $save = Role::create(['name'=>$request->name]);

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
        $data['title']   = 'Detail Role';
        $data['subtitle']= 'this is the management roles menu';
        $data['row']     = Role::where('id',$id)->first();
        return view('admin.cms.role.show',$data);
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
        $data['title']   = 'Edit Role';
        $data['subtitle']= 'this is the management roles menu';
        $data['row']     = Role::where('id',$id)->first();
        return view('admin.cms.role.edit',$data);
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
        ]);

        $fetch_one = Role::where('id',$request->id)->first();

        if($request->name == $fetch_one->name){
            $update = true;
        }else{

            $request->validate([
                'name'      => 'required|string|unique:cms_role,name',
            ]);

            $update = Role::where('id',$request->id)->update(['name'=>$request->name]);

        }

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
