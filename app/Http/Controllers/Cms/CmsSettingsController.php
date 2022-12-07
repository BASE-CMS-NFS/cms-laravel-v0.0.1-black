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
use App\Models\Cms\CmsSettings;

class CmsSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function init(){
        $data['link']='cms_settings';

        return $data;
    }

    public function index()
    {
        $data                   = Self::init();
        $data['title']          = 'Managemet Settings';
        $data['cms_settings']   = CmsSettings::paginate(20);
        return view('admin.cms.setting.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data                   = Self::init();
        $data['title']   = 'Create Settings';
        $data['subtitle']= 'this is the management settings menu';
        return view('admin.cms.setting.create',$data);
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
            'name'                => 'required|string',
            'value'               => 'required|string',
        ]);

        $save = CmsSettings::insertData($request);

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
        $data['title']   = 'Detail Settings';
        $data['subtitle']= 'this is the management settings menu';
        $data['row']     = CmsSettings::find($id);
        return view('admin.cms.setting.show',$data);
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
        $data['title']   = 'Edit Settings';
        $data['subtitle']= 'this is the management settings menu';
        $data['row']     = CmsSettings::find($id);
        return view('admin.cms.setting.edit',$data);
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
            'value'               => 'required|string',
        ]);

        $update = CmsSettings::updateData($request);
        
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
        $delete = CmsSettings::where('id',$id)->delete();

        if($delete){
            return redirect()->back()->with('message','success delete data')->with('message_type','primary');
        }else{
            return redirect()->back()->with('message','failed delete data')->with('message_type','warning');
        }
    }
}
