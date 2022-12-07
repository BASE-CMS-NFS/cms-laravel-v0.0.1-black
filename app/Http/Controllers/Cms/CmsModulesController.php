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

class CmsModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function init(){
        $data['link']='cms_modules';

        return $data;
    }

    public function index()
    {
        $data                   = Self::init();
        $data['title']          = 'Module Generator';
        $data['cms_modules']    = CmsModules::leftJoin('cms_settings','cms_modules.cms_settings_id','=','cms_settings.id')
                                  ->select('cms_modules.*','cms_settings.name as cms_settings_name')->get();

        return view('admin.cms.module.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data                   = Self::init();
        $data['title']          = 'Create Modules';
        $data['subtitle']       = 'this is the management modules generator';
        $data['cms_settings']   = CmsSettings::all();
        return view('admin.cms.module.create',$data);
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
            'name'                => 'required|string|unique:cms_modules,name',
            'icon'                => 'required|string',
            'middleware'          => 'required|string',
            'controller'          => 'required|string|unique:cms_modules,controller',
            'model'               => 'required|string|unique:cms_modules,model',
            'table'               => 'required|string',
            'status'              => 'required|string',
            'folder_controller'   => 'required|string',
            'folder_model'        => 'required|string',
            'folder_storage'      => 'required|string',
        ]);

        $save = CmsModules::insertData($request);

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
        $data['title']          = 'Detail Modules';
        $data['subtitle']       = 'this is the management modules generator';
        $data['row']            = CmsModules::fetchOne($id);

        return view('admin.cms.module.show',$data);
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
        $data['title']          = 'Edit Modules';
        $data['subtitle']       = 'this is the management modules generator';
        $data['cms_settings']   = CmsSettings::all();
        $data['row']            = CmsModules::fetchOne($id);
        
        return view('admin.cms.module.edit',$data);
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
            'id'                  => 'required',
            'name'                => 'required|string',
            'icon'                => 'required|string',
            'middleware'          => 'required|string',
            'controller'          => 'required|string',
            'model'               => 'required|string',
            'table'               => 'required|string',
            'status'              => 'required|string',
            'folder_controller'   => 'required|string',
            'folder_model'        => 'required|string',
            'folder_storage'      => 'required|string',
        ]);

        $update = CmsModules::updateData($request);

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
        //INI AKAN MENDELETE MENU, MENU ACCESS, MENU DETAIL DAN ROLE ACCESS

        $check = CmsMenus::where('cms_modules_id',$id)->first();

        if($check){
            $delete_folder_view = Nfs::deleteFolderAllGenerator($id,$check->id);
            
            Nfs::deleteAllMenusRelasi($check->id);
        }

        //delete modules
        $delete = CmsModules::where('id',$id)->delete();


        if($delete){
            return redirect()->back()->with('message','success delete data')->with('message_type','primary');
        }else{
            return redirect()->back()->with('message','failed delete data')->with('message_type','warning');
        }
    }

    public function generate($id)
    {

        $check = CmsMenus::where('cms_modules_id',$id)->where('type','full module')->first();

        if($check){
            if($check->type == 'full module'){
                Nfs::createController($id,$check->id);
                Nfs::createModels($id,$check->id);
                Nfs::createView($check->id);

                return redirect()->back()->with('message','success generate modules '.$check->name)->with('message_type','primary');
            }else{
                return redirect()->back()->with('message','menu management type full module not found, please create it')->with('message_type','warning');
            }
            
        }else{
            return redirect()->back()->with('message','menu management not found, please create it')->with('message_type','warning');
        }
    }
}
