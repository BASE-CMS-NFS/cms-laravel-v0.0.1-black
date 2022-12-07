<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
#PACKAGE
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
use App\Models\Cms\CmsSettings;
use App\Models\Cms\CmsModules;
use App\Models\Cms\CmsMenus;
use App\Models\Cms\CmsMenusAccess;

class CmsMenusAccessController extends Controller
{

    public static function init(){
        $data['link']           ='cms_menus';
        $data['cms_role']       = Role::all();
        $data['users']          = User::fetch_one(Session::get('id'));
        $data['cms_role_access']= false;
        $data['table']          = 'cms_menu_access';
        $data['title']          = 'Management Menu Access';
        $data['description']    = 'Ini adalah pengaturan untuk menu access setiap role';

        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cms_menus_id)
    {
        $data                   = Self::init();
        $data['row']            = CmsMenus::fetchOne($cms_menus_id);
        $data['cms_menus_access'] = CmsMenusAccess::fetchAll($cms_menus_id);

        
        return view('admin.cms.menu_access.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cms_menus_id)
    {
        //
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
            'cms_role_id'      => 'required',
            'cms_menus_id'     => 'required',
        ]);

        $save = CmsMenusAccess::create(
            [
                'cms_role_id'   => $request->cms_role_id,
                'cms_menus_id'  => $request->cms_menus_id,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cms_menus_id,$id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($cms_menus_id,Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CmsMenusAccess::where('id',$id)->delete();
        
        if($delete){
            return redirect()->back()->with('message','success delete data')->with('message_type','primary');
        }else{
            return redirect()->back()->with('message','failed delete data')->with('message_type','warning');
        }
    }
}
