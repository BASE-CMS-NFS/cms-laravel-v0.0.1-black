<?php
namespace App\Helpers;

use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Http;
use Image;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Cms\Role;
use App\Models\Cms\CmsSettings;
use App\Models\Cms\CmsModules;
use App\Models\Cms\CmsMenus;
use App\Models\Cms\CmsMenusAccess;
use App\Models\Cms\CmsLogs;
use App\Models\Cms\CmsRoleAccess;
use App\Models\Cms\CmsMenusDetail;

use Illuminate\Support\Facades\Schema;


class Nfs {
   
    //default nama app
    public static function app(){
        return "NonScrap";
    }

    //default route admin
    public static function admin_path(){
        
        return "admin";
    }

    //default route superadmin
    public static function superadmin_path(){
        
        return "superadmin";
    }

    //DIGUNAKAN DI MENU ACCESS GENERATE ROUTE 
    public static function route($cms_menus_id){
        $data = CmsMenus::join('cms_modules','cms_menus.cms_modules_id','=','cms_modules.id')
                ->join('cms_menus_detail','cms_menus.id','=','cms_menus_detail.cms_menus_id')
                ->where('cms_menus.id',$cms_menus_id)
                ->select('cms_modules.*','cms_menus_detail.url as route_url',
                        'cms_menus_detail.function as route_function','cms_menus_detail.method as route_method',
                        )
                ->get();
        
        //module management 
        $text = [];
        foreach($data as $key){
           $route  = explode("(", $key->route_function);
           $url['url']='Route::'.$key->route_method.'("'.$key->route_url.'",['.$key->controller.'::class,"'.$route[0].'"]);';
           array_push($text,$url);
        }

        return $text;
        
    }

    //DIGUNAKAN DI MENU ROUTE UNTUK MENGGENERATE URL CLASS
    public static function controller($cms_menus_id){
        $data = CmsModules::join('cms_menus','cms_modules.id','=','cms_menus.cms_modules_id')
                ->where('cms_menus.id',$cms_menus_id)
                ->select('cms_modules.*')
                ->get();
                
        $text = [];
        foreach($data as $key){
            $list['class'] = "use App\Http\Controllers\\".$key->folder_controller.'\\'.$key->controller.';';

            array_push($text,$list);
        }

        return $text;
    }

    //DIGUNAKAN DI SIDEBAR UNTUK MENGANALISIS ROLE PRIVILEGES
    public static function menu($user_id)
    {
        $data = CmsMenus::leftJoin('cms_menus_access','cms_menus.id','=','cms_menus_access.cms_menus_id')
                ->leftJoin('cms_role','cms_menus_access.cms_role_id','=','cms_role.id')
                ->join('users','cms_role.id','=','users.cms_role_id')
                ->whereNull('cms_menus.parent_id')
                ->where('users.id',$user_id)
                ->where('cms_menus.status','active')
                ->orderBy('cms_menus.sorter','desc')
                ->select('cms_menus.*','cms_role.name as cms_role_name','cms_menus_access.*')
                ->get();
        
        return $data;
    }

    //DIGUNAKAN DI SUB MENU MANAGEMENT DAN SIDEBAR
    public static function submenu($parent_id)
    {
        $data = CmsMenus::where('cms_menus.parent_id',$parent_id)
                ->orderBy('cms_menus.sorter','desc')
                ->get();
        
        return $data;
    }

    public static function submenuSidebar($user_id,$parent_id)
    {
        $data = CmsMenus::leftJoin('cms_menus_access','cms_menus.id','=','cms_menus_access.cms_menus_id')
                ->leftJoin('cms_role','cms_menus_access.cms_role_id','=','cms_role.id')
                ->join('users','cms_role.id','=','users.cms_role_id')
                ->where('cms_menus.parent_id',$parent_id)
                ->where('users.id',$user_id)
                ->where('cms_menus.status','active')
                ->orderBy('cms_menus.sorter','desc')
                ->select('cms_menus.*','cms_role.name as cms_role_name','cms_menus_access.*')
                ->get();
        
        return $data;
    }


    //buat function di view role access
    public static function roleAccess($cms_role_id,$cms_menus_id){
        $data = CmsRoleAccess::where('cms_role_id',$cms_role_id)
                ->where('cms_menus_id',$cms_menus_id)
                ->first();

        return $data;
    }

    public static function role(){
        $data = Role::all();

        return $data;
    }


    //FUNGSI ENCRYPSI 
    public static function Encrypt($value){

        $encrypted = Crypt::encryptString($value);

        return $encrypted;
    }

    //FUNGSI DECRIPSI
    public static function Decrypt($value){
        
        $decrypted = Crypt::decryptString($value);

        return $decrypted;
    }

    //FUNGSI INSERT LOGS USERS
    public static function insertLogs($description){
        $detail ='aktivitas pada jam '.date('H:i:s');
        $save = CmsLogs::saveData($description,$detail);

        return $save;
    }


    //FUNGSI DELETE MENU DAN MENU_DETAIL DAN MENU ACCESS DAN ROLE ACCESS

    public static function deleteAllMenusRelasi($cms_menus_id){
        $delete_menu_access = CmsMenusAccess::where('cms_menus_id',$cms_menus_id)->delete();
        $delete_menu_detail = CmsMenusDetail::where('cms_menus_id',$cms_menus_id)->delete();
        $delete_role_access = CmsRoleAccess::where('cms_menus_id',$cms_menus_id)->delete();
        $delete_menus       = CmsMenus::where('id',$cms_menus_id)->delete();

        return $delete_menus;
    }

    public static function updateAllMenusRelasi($cms_menus_id){
        $delete_menu_access = CmsMenusAccess::where('cms_menus_id',$cms_menus_id)->delete();
        $delete_menu_detail = CmsMenusDetail::where('cms_menus_id',$cms_menus_id)->delete();
        $delete_role_access = CmsRoleAccess::where('cms_menus_id',$cms_menus_id)->delete();

        return $delete_menu_detail;
    }

    //MEMBUAT DEFAULT MENU ACCESS, ROLE ACCESS , MENU DETAIL SAAT MEMBUAT MENU

    public static function createDeafultValueOnlyMenu($cms_menus_id){
        //MENGAMBIL INFO MENU DETAIL
        $fetch = CmsMenus::where('id',$cms_menus_id)->first();
        
        //MEMBUAT ROLE ACCESS
        $role = Role::all();
        $role_access = [];
        foreach($role as $key){
            $list['cms_role_id']    = $key->id;
            $list['cms_menus_id']   = $cms_menus_id;
            $list['is_view']        = "false";
            $list['is_create']      = "false";
            $list['is_edit']        = "false";
            $list['is_detail']      = "false";
            $list['is_delete']      = "false";

            array_push($role_access,$list);
        }
        CmsRoleAccess::insert($role_access);

        //MEMBUAT MENU ACCESS
        DB::table('cms_menus_access')->insert([
            [
                "cms_menus_id" => $cms_menus_id,
                "cms_role_id"  => 1,
            ],
            [
                "cms_menus_id" => $cms_menus_id,
                "cms_role_id"  => 2,
            ],
        ]);

        return true;
    }

    public static function createDeafultValue($cms_menus_id){
        //MENGAMBIL INFO MENU DETAIL
        $fetch = CmsMenus::where('id',$cms_menus_id)->first();
        
        //MEMBUAT ROLE ACCESS
        $role = Role::all();
        $role_access = [];
        foreach($role as $key){
            $list['cms_role_id']    = $key->id;
            $list['cms_menus_id']   = $cms_menus_id;
            $list['is_view']        = "false";
            $list['is_create']      = "false";
            $list['is_edit']        = "false";
            $list['is_detail']      = "false";
            $list['is_delete']      = "false";

            array_push($role_access,$list);
        }
        CmsRoleAccess::insert($role_access);

        //MEMBUAT MENU ACCESS
        DB::table('cms_menus_access')->insert([
            [
                "cms_menus_id" => $cms_menus_id,
                "cms_role_id"  => 1,
            ],
            [
                "cms_menus_id" => $cms_menus_id,
                "cms_role_id"  => 2,
            ],
        ]);

        //MEMBUAT MENU DETAIL
        $return = DB::table('cms_menus_detail')->insert([
            [
                "cms_menus_id"=>$cms_menus_id,
                "url"         =>$fetch->url.'/{menu_detail}',
                "method"      =>'get',
                "function"    =>'index($menu_id)',
                "view"        =>'index.blade.php'
            ],
            [
                "cms_menus_id"=>$cms_menus_id,
                "url"         =>$fetch->url.'/create/{menu_detail}',
                "method"      =>'get',
                "function"    =>'create($menu_id)',
                "view"        =>'create.blade.php'
            ],
            [
                "cms_menus_id"=>$cms_menus_id,
                "url"         =>$fetch->url.'/edit/{menu_detail}/{id}',
                "method"      =>'get',
                "function"    =>'edit($menu_id,$id)',
                "view"        =>'edit.blade.php'
            ],
            [
                "cms_menus_id"=>$cms_menus_id,
                "url"         =>$fetch->url.'/show/{menu_detail}/{id}',
                "method"      =>'get',
                "function"    =>'show($menu_id,$id)',
                "view"        =>'show.blade.php'
            ],
            [
                "cms_menus_id"=>$cms_menus_id,
                "url"         =>$fetch->url.'/store',
                "method"      =>'post',
                "function"    =>'store(Request $request)',
                "view"        =>''
            ],
            [
                "cms_menus_id"=>$cms_menus_id,
                "url"         =>$fetch->url.'/update',
                "method"      =>'post',
                "function"    =>'update(Request $request)',
                "view"        =>''
            ],
            [
                "cms_menus_id"=>$cms_menus_id,
                "url"         =>$fetch->url.'/destroy/{menu_detail}/{id}',
                "method"      =>'get',
                "function"    =>'destroy($menu_detail,$id)',
                "view"        =>''
            ],
        ]);
        
        return $return;

    }

    //========================= FUNCTION MEMBUAT FOLDER =============================

    public static function createFolderController($name){
        //NAME FOLDER DI CONTROLLERS
        $folder = app_path('Http/Controllers/'.$name);

        if(!File::isDirectory($folder)){
            File::makeDirectory($folder, 0777, true, true);
        }

        return $folder;

    }

    public static function createFolderModels($name){
        //NAME FOLDER DI Models
        $folder = app_path('Models/'.$name);

        if(!File::isDirectory($folder)){
            File::makeDirectory($folder, 0777, true, true);
        }

        return $folder;
    }

    public static function createFolderStorage($name){
        //NAME FOLDER DI Models
        $folder = storage_path('app/public/'.$name);

        if(!File::isDirectory($folder)){
            File::makeDirectory($folder, 0777, true, true);
        }

        return $folder;
    }

    public static function createFolderMainView($main){
        //NAME FOLDER DI Models
        $folder = resource_path('views/admin/'.$main.'/');

        if(!File::isDirectory($folder)){
            File::makeDirectory($folder, 0777, true, true);
        }

        return $folder;
    }

    public static function createFolderSubView($main,$sub){
        //NAME FOLDER DI Models
        $folder = resource_path('views/admin/'.$main.'/'.$sub.'/');

        if(!File::isDirectory($folder)){
            File::makeDirectory($folder, 0777, true, true);
        }

        return $folder;
    }

    public static function deleteFolderOnlyMenus($cms_menu_id){
        $menu  = CmsMenus::where('id',$cms_menu_id)->first();

        // Check and delete view
        $blade_view = resource_path('views/admin/'.$menu->main_folder.'/'.$menu->sub_folder.'/');

        if(File::isDirectory($blade_view)){
            File::deleteDirectory($blade_view);
        }

        return true;
    }

    public static function deleteFolderAllGenerator($id,$cms_menu_id){
        $fetch = CmsModules::where('id',$id)->first();
        $menu  = CmsMenus::where('id',$cms_menu_id)->first();

        // Check and delete view
        $blade_view = resource_path('views/admin/'.$menu->main_folder.'/'.$menu->sub_folder.'/');

        if(File::isDirectory($blade_view)){
            File::deleteDirectory($blade_view);
        }

        // delete storage folder
        $storage = storage_path('app/public/'.$fetch->file_storage);

        if(File::isDirectory($storage)){
            File::deleteDirectory($storage);
        }

        //delete file controller
        $controller = app_path('Http/Controllers/'.$fetch->file_controller.'/'.$fetch->controller.'.php');
        if(file_exists($controller)){
            File::delete($controller);
        }

        //delete file model
        $model = app_path('Models/'.$fetch->file_model.'/'.$fetch->model.'.php');
        if(file_exists($model)){
            File::delete($model);
        }

        return true;

    }

    //========================= FUNCTION MEMBUAT FOLDER =============================

    //GET SCHEMAA TABEL
    public static function getTableColumns($table)
        {
            // OR

            return Schema::getColumnListing($table);

        }


    // ======================= FUNCTION CREATE CONTROLLER , MODEL DAN VIEW ===============

    public static function createController($id,$cms_menu_id){

        //MENGAMBIL DATA DARI MODULES

        $fetch = CmsModules::where('id',$id)->first();
        $menu  = CmsMenus::where('id',$cms_menu_id)->first();

        $name               = $fetch->name;
        $icon               = $fetch->middleware;
        $controller         = $fetch->controller;
        $model              = $fetch->model;
        $table              = $fetch->table;
        $status             = $fetch->status;
        $folder_controller  = $fetch->folder_controller;
        $folder_model       = $fetch->folder_model;
        $folder_storage     = $fetch->folder_storage;

        //CREATE FOLDER
        Self::createFolderController($folder_controller);
        Self::createFolderModels($folder_controller);
        Self::createFolderStorage($folder_storage);
        

        $php = '
		<?php namespace App\Http\Controllers\\'.$folder_controller.';';
        
        $php .= "\n".'
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

		class '.$controller.' extends Controller {
		';

        $php .="\n".'
            public static function init($menu_id){
                $cms_menu_id            = Nfs::Decrypt($menu_id);
                //enkripsi
        
                $menu                   = CmsMenus::fetchOne($cms_menu_id);
                $data["access"]         = Nfs::roleAccess(Session::get("cms_role_id"),$cms_menu_id);
                $data["title"]          = "'.$menu->name.'";
                $data["description"]    = "ini adalah menu management '.$menu->name.'";
                $data["users"]          = User::fetch_one(Session::get("id"));
                $data["tabel"]          = "'.$table.'";
                $data["link"]           = $menu->url;
                return $data;
            }
        ';

        $php .= "\n".'
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index($menu_id)
            {
                $data = Self::init($menu_id);

                if($data["access"]->is_view == "false" || $data["access"]->is_view == null ){
                    return redirect("dashboard")->with("message","cannot access this menu, you dont have prifileges")
                        ->with("message_type","danger");
                }

                return view("admin.'.$menu->main_folder.'.'.$menu->sub_folder.'.index",$data);
            }';

        $php .= "\n".'
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create($menu_id)
            {
                $data = Self::init($menu_id);

                if($data["access"]->is_view == "false" || $data["access"]->is_view == null ){
                    return redirect("dashboard")->with("message","cannot access this menu, you dont have prifileges")
                        ->with("message_type","danger");
                }

                return view("admin.'.$menu->main_folder.'.'.$menu->sub_folder.'.create",$data);
            }';

        $php .= "\n".'
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function edit($menu_id,$id)
            {
                $data = Self::init($menu_id);

                if($data["access"]->is_view == "false" || $data["access"]->is_view == null ){
                    return redirect("dashboard")->with("message","cannot access this menu, you dont have prifileges")
                        ->with("message_type","danger");
                }

                return view("admin.'.$menu->main_folder.'.'.$menu->sub_folder.'.edit",$data);
            }';

        $php .= "\n".'
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function show($menu_id,$id)
            {
                $data = Self::init($menu_id);

                if($data["access"]->is_view == "false" || $data["access"]->is_view == null ){
                    return redirect("dashboard")->with("message","cannot access this menu, you dont have prifileges")
                        ->with("message_type","danger");
                }

                return view("admin.'.$menu->main_folder.'.'.$menu->sub_folder.'.show",$data);
            }';

        $php .= "\n".'
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {
                

                if($save){
                    return redirect()->back()->with("message","success save data")->with("message_type","primary");
                }else{
                    return redirect()->back()->with("message","failed save data")->with("message_type","warning");
                }
            }';

        $php .= "\n".'
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function update(Request $request)
            {
                

                if($update){
                    return redirect()->back()->with("message","success update data")->with("message_type","primary");
                }else{
                    return redirect()->back()->with("message","failed update data")->with("message_type","warning");
                }
            }';

        $php .= "\n".'
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function destroy($menu_id,$id)
            {
                $data = Self::init($menu_id);

                if($data["access"]->is_view == "false" || $data["access"]->is_view == null ){
                    return redirect("dashboard")->with("message","cannot access this menu, you dont have prifileges")
                        ->with("message_type","danger");
                }

                if($delete){
                    return redirect()->back()->with("message","success delete data")->with("message_type","primary");
                }else{
                    return redirect()->back()->with("message","failed delete data")->with("message_type","warning");
                }
            }
            
        }';

        $php = trim($php);
        $path = base_path("app/Http/Controllers/".$folder_controller."/");
        file_put_contents($path.$controller.'.php', $php);

        return true;
    }

    public static function createModels($id,$cms_menu_id){

        //MENGAMBIL DATA DARI MODULES

        $fetch = CmsModules::where('id',$id)->first();
        $menu  = CmsMenus::where('id',$cms_menu_id)->first();

        $name               = $fetch->name;
        $icon               = $fetch->middleware;
        $controller         = $fetch->controller;
        $model              = $fetch->model;
        $table              = $fetch->table;
        $status             = $fetch->status;
        $folder_controller  = $fetch->folder_controller;
        $folder_model       = $fetch->folder_model;
        $folder_storage     = $fetch->folder_storage;

        $schema = Self::getTableColumns($table);

        $txt = '';
        for($i=0;$i<count($schema);$i++){
            $txt .='"'.$schema[$i].'",';
        }

        $php ="\n".'
		<?php 
        
        namespace App\Models\\'.$folder_model.';';

        $php .= "\n".'
		use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;
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

		class '.$model.' extends Model {
		';

        $php .= "\n".'
        use HasFactory;
        protected $table = "'.$table.'";
        ';
        
        $php .= "\n".'
        protected $fillable = [
            '.$txt.'
        ];
    
    }';

        $php = trim($php);
        $path = base_path("app/Models/".$folder_model."/");
        file_put_contents($path.$model.'.php', $php);

        return true;
    }

    public static function createView($cms_menu_id){
        $menu_detail  = CmsMenus::join('cms_menus_detail','cms_menus.id','=','cms_menus_detail.cms_menus_id')
                        ->where('cms_menus_detail.cms_menus_id',$cms_menu_id)
                        ->select('cms_menus.*','cms_menus_detail.view')
                        ->get();
        $menu  = CmsMenus::where('id',$cms_menu_id)->first();

               Self::createFolderMainView($menu->main_folder);
       $path = Self::createFolderSubView($menu->main_folder,$menu->sub_folder);

        $php = "\n".'
            @extends("template.content")
            @section("content")

            @endsection
        ';

        $php = trim($php);
        foreach($menu_detail as $key){
            if($key->view){
                file_put_contents($path.$key->view, $php);
            }
        }
        return true;
    }

}
