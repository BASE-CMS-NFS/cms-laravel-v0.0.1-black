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
use App\Models\Cms\CmsEmails;

class CmsEmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function init(){
        $data['link']='cms_emails';

        return $data;
    }

    public function index()
    {
        $data                   = Self::init();
        $data['title']          = 'Emails Template';
        $data['cms_emails']     = CmsEmails::all();

        return view('admin.cms.email.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data                   = Self::init();
        $data['title']          = 'Create Email Templates';
        $data['subtitle']       = 'this is the management email templates';
        $data['cms_modules']    = CmsModules::all();
        $data['cms_menus']      = CmsMenus::all();
        return view('admin.cms.email.create',$data);
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
                'name'               => 'required|string',
                'slug'               => 'required|string',
                'subject'            => 'required|string',
                'content'            => 'required|string',
                'description'        => 'required|string',
                'from_name'          => 'required|string',
                'from_email'         => 'required|string',
            ]);

            $save = CmsEmails::insertData($request);

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
        $data            = Self::init();
        $data['title']   = 'Detail Email Templates';
        $data['subtitle']= 'this is the management email templates';
        $data['row']     = CmsEmails::find($id);
        return view('admin.cms.email.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data            = Self::init();
        $data['title']   = 'Edit Email Templates';
        $data['subtitle']= 'this is the management email templates';
        $data['row']     = CmsEmails::find($id);
        return view('admin.cms.email.edit',$data);
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
            'id'                 => 'required',
            'name'               => 'required|string',
            'slug'               => 'required|string',
            'subject'            => 'required|string',
            'content'            => 'required|string',
            'description'        => 'required|string',
            'from_name'          => 'required|string',
            'from_email'         => 'required|string',
        ]);

        $update = CmsEmails::updateData($request);
        
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
        $check = CmsEmails::where('id',$id)->first();

        Helper::deleteImage($check->image);
        
        $delete = CmsEmails::where('id',$id)->delete();

        if($delete){
            return redirect()->back()->with('message','success delete data')->with('message_type','primary');
        }else{
            return redirect()->back()->with('message','failed delete data')->with('message_type','warning');
        }
    }
}
