<?php 
        
        namespace App\Models\Microservice;

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

		class Instagram extends Model {
		

        use HasFactory;
        protected $table = "instagram";
        

        protected $fillable = [
            
        ];
    
    }