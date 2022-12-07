<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsModules extends Model
{
    use HasFactory;
    protected $table = 'cms_modules';
    protected $fillable = [
        'name',
        'icon',
        'middleware',
        'controller',
        'model',
        'table',
        'status',
        'folder_controller',
        'folder_model',
        'folder_storage',
        'cms_settings_id',
    ];

    public static function insertData($request){

        $save = CmsModules::create([
            'name'              => $request->name,
            'icon'              => $request->icon,
            'middleware'        => $request->middleware,
            'controller'        => $request->controller,
            'model'             => $request->model,
            'table'             => $request->table,
            'status'            => $request->status,
            'folder_controller' => $request->folder_controller,
            'folder_model'      => $request->folder_model,
            'folder_storage'    => $request->folder_storage,
            'cms_settings_id'   => $request->cms_settings_id,
        ]);

        return $save;

    }

    public static function updateData($request){

        $update = CmsModules::where('id',$request->id)->update([
            'name'              => $request->name,
            'icon'              => $request->icon,
            'middleware'        => $request->middleware,
            'controller'        => $request->controller,
            'model'             => $request->model,
            'table'             => $request->table,
            'status'            => $request->status,
            'folder_controller' => $request->folder_controller,
            'folder_model'      => $request->folder_model,
            'folder_storage'    => $request->folder_storage,
            'cms_settings_id'   => $request->cms_settings_id,
        ]);

        return $update;

    }

    public static function fetchOne($id){
        $data = CmsModules::leftJoin('cms_settings','cms_modules.cms_settings_id','=','cms_settings.id')
                ->where('cms_modules.id',$id)
                ->select('cms_modules.*','cms_settings.name as cms_settings_name','cms_settings.value as cms_settings_value',
                'cms_settings.description as cms_settings_description','cms_settings.image as cms_settings_image')
                ->first();

        return $data;
    }
}
