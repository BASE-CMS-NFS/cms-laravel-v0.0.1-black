<?php namespace App\Http\Controllers\Microservice;

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

		class InstagramController extends Controller {
		

            public static function init($menu_id){
                $cms_menu_id            = Nfs::Decrypt($menu_id);
                //enkripsi
        
                $menu                   = CmsMenus::fetchOne($cms_menu_id);
                $data["access"]         = Nfs::roleAccess(Session::get("cms_role_id"),$cms_menu_id);
                $data["title"]          = "Instagram";
                $data["description"]    = "ini adalah menu management Instagram";
                $data["users"]          = User::fetch_one(Session::get("id"));
                $data["tabel"]          = "instagram";
                $data["link"]           = $menu->url;
                return $data;
            }
        

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

                return view("admin.microservice.instagram.index",$data);
            }

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

                return view("admin.microservice.instagram.create",$data);
            }

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

                return view("admin.microservice.instagram.edit",$data);
            }

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

                return view("admin.microservice.instagram.show",$data);
            }

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
            }

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
            }

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
            
        }