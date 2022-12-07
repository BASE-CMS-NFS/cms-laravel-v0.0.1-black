<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsMenusAccess extends Model
{
    use HasFactory;
    protected $table = 'cms_menus_access';
    protected $fillable = [
        'cms_menus_id',
        'cms_role_id',
    ];


    public static function fetchAll($cms_menus_id){
        $data = CmsMenusAccess::join('cms_role','cms_menus_access.cms_role_id','=','cms_role.id')
                ->join('cms_menus','cms_menus_access.cms_menus_id','=','cms_menus.id')
                ->where('cms_menus.id',$cms_menus_id)
                ->select('cms_menus_access.*','cms_role.name as cms_role_name','cms_menus.name as cms_menus_name')
                ->get();

        return $data;
    }


}
