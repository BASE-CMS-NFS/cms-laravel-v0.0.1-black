<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class CmsLogs extends Model
{
    use HasFactory;
    protected $table = 'cms_logs';

    protected $fillable = [
        'ipaddress',
        'useragent',
        'url',
        'description',
        'details',
        'users_id',
        'created_at',
        'updated_at'
    ];

    public static function saveData($description,$details){
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(Session::has('id')){
            $users_id = Session::get('id');
        }else{
            $users_id = Null;
        }

        $save = CmsLogs::create([
            "ipaddress"     =>$_SERVER['REMOTE_ADDR'],
            "useragent"     =>$_SERVER['HTTP_USER_AGENT'],
            "url"           => $actual_link,
            "created_at"    =>date('Y-m-d H:i:s'),
            "updated_at"    =>date('Y-m-d H:i:s'),
            "description"   =>$description,
            "details"       =>$details,
            "users_id"      =>$users_id
        ]);

        return $save;
    }
}
