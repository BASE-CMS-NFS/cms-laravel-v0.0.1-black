<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsMenusDetail extends Model
{
    use HasFactory;
    protected $table = 'cms_menus_detail';
    protected $fillable = [
        'cms_menus_id',
        'url',
        'view',
        'function',
        'method',
    ];

    public static function fetchOne($id){
        $data = CmsMenusDetail::join('cms_menus','cms_menus_detail.cms_menus_id','=','cms_menus.id')
                ->where('cms_menus_detail.id',$id)
                ->select('cms_menus_detail.*','cms_menus.name as cms_menus_name')
                ->first();

        return $data;
    }

    public static function fetchAll($cms_menus_id){
        $data = CmsMenusDetail::join('cms_menus','cms_menus_detail.cms_menus_id','=','cms_menus.id')
                ->where('cms_menus_detail.cms_menus_id',$cms_menus_id)
                ->select('cms_menus_detail.*','cms_menus.name as cms_menus_name')
                ->get();

        return $data;
    }

    public static function insertData($request){

        $save = CmsMenusDetail::create([
            'cms_menus_id'  => $request->cms_menus_id,
            'url'           => $request->url,
            'view'          => $request->view,
            'function'      => $request->function,
            'method'      => $request->method,
        ]);

        return $save;

    }

    public static function updateData($request){

        $update = CmsMenusDetail::where('id',$request->id)->update([
            'cms_menus_id'  => $request->cms_menus_id,
            'url'           => $request->url,
            'view'          => $request->view,
            'function'      => $request->function,
            'method'      => $request->method,
        ]);

        return $update;

    }
}
