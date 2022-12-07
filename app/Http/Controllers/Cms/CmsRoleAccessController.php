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
use App\Models\Cms\CmsRoleAccess;

class CmsRoleAccessController extends Controller
{
    public static function init(){
        $data['link']='cms_role';

        return $data;
    }

    public function index($role_id)
    {
        $data           = Self::init();
        $data['title']  = 'Management Role Access';
        $data['menu']   = CmsMenus::all();
        $data['row']   = Role::find($role_id);

        return view('admin.cms.role_access.index',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        $save = CmsRoleAccess::insertData($request);
        

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
    public function edit($id)
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
    public function update(Request $request, $id)
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
        //
    }
}
