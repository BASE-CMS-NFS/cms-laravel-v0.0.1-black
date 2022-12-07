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

class CmsMenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function init(){
        $data['link']='cms_menus';

        return $data;
    }

    public function index()
    {
        $data                   = Self::init();
        $data['title']          = 'Menu Management';
        $data['cms_menus']      =  CmsMenus::fetchAll();

        return view('admin.cms.menu.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data                   = Self::init();
        $data['title']          = 'Create Menus';
        $data['subtitle']       = 'this is the management menu';
        $data['cms_modules']    = CmsModules::all();
        $data['cms_menus']      = CmsMenus::all();
        return view('admin.cms.menu.create',$data);
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
            'name'                => 'required|string|unique:cms_menus,name',
            'icon'                => 'required|string',
            'cms_modules_id'      => 'required|string',
            'url'                 => 'required|string',
            'sub_folder'          => 'required|string',
            'sorter'              => 'required|integer',
            'status'              => 'required|string',
            'main_folder'         => 'required|string',
            'type'                => 'required|string',
        ]);

        $save = CmsMenus::insertData($request);

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
        $data['title']          = 'Edit Menus';
        $data['subtitle']       = 'this is the management menu';
        $data['row']            = CmsMenus::fetchOne($id);
        return view('admin.cms.menu.show',$data);
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
        $data['title']          = 'Edit Menus';
        $data['subtitle']       = 'this is the management menu';
        $data['cms_modules']    = CmsModules::all();
        $data['cms_menus']      = CmsMenus::all();
        $data['row']            = CmsMenus::fetchOne($id);
        return view('admin.cms.menu.edit',$data);
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
            'cms_modules_id'      => 'required|string',
            'url'                 => 'required|string',
            'sub_folder'          => 'required|string',
            'sorter'              => 'required|string',
            'status'              => 'required|string',
            'main_folder'         => 'required|string',
            'type'                => 'required|string',
        ]);

        $update = CmsMenus::updateData($request);

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
        $delete_folder_view = Nfs::deleteFolderOnlyMenus($id);

        //delete semua relasi menus
        $delete = Nfs::deleteAllMenusRelasi($id);
        
        if($delete){
            return redirect()->back()->with('message','success delete data')->with('message_type','primary');
        }else{
            return redirect()->back()->with('message','failed delete data')->with('message_type','warning');
        }
    }

    public function action($id)
    {
        $data                   = Self::init();
        $data['title']          = 'Menu Management';
        $data['description']    =  'ini adalah submenu untuk membuat modul di bawah menu management';
        $data['row']            = CmsMenus::fetchOne($id);

        return view('admin.cms.menu.subaction',$data);
    }

    public function status($id,$status)
    {   
        //delete semua relasi menus
        $update = CmsMenus::where('id',$id)
                ->update([
                    "status"=>$status
                ]);
        
        if($update){
            return redirect()->back()->with('message','success update status')->with('message_type','primary');
        }else{
            return redirect()->back()->with('message','failed update status')->with('message_type','warning');
        }
    }
}
