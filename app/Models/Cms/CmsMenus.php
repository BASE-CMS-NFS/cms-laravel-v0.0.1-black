<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nfs;

class CmsMenus extends Model
{
    use HasFactory;
    protected $table = 'cms_menus';
    protected $fillable = [
        'cms_modules_id',
        'parent_id',
        'icon',
        'name',
        'url',
        'main_folder',
        'sub_folder',
        'status',
        'sorter',
        'type',
    ];

    public static function fetchOne($id){
        $data = CmsMenus::leftJoin('cms_modules','cms_menus.cms_modules_id','=','cms_modules.id')
                ->leftJoin('cms_menus as parent','cms_menus.parent_id','=','parent.id')
                ->where('cms_menus.id',$id)
                ->select('cms_menus.*','parent.name as parent_name','cms_modules.name as cms_modules_name')
                ->first();

        return $data;
    }

    public static function fetchAll(){
        $data = CmsMenus::leftJoin('cms_modules','cms_menus.cms_modules_id','=','cms_modules.id')
                ->leftJoin('cms_menus as parent','cms_menus.parent_id','=','parent.id')
                ->whereNull('cms_menus.parent_id')
                ->select('cms_menus.*','parent.name as parent_name','cms_modules.name as cms_modules_name')
                ->orderBy('cms_menus.sorter','asc')
                ->get();

        return $data;
    }


    public static function insertData($request){

        $save = CmsMenus::create([
            'cms_modules_id' => $request->cms_modules_id,
            'parent_id'      => $request->parent_id,
            'icon'           => $request->icon,
            'name'           => $request->name,
            'url'            => $request->url,
            'main_folder'    => $request->main_folder,
            'sub_folder'     => $request->sub_folder,
            'status'         => $request->status,
            'sorter'         => $request->sorter,
            'type'           => $request->type,
        ]);

        //melakukan insert default di access menu
        if($request->type == 'full module'){
            $id = $save->id;
            Nfs::createDeafultValue($id);
        }else{
            Nfs::createDeafultValueOnlyMenu($id);
        }

        return $save;

    }

    public static function updateData($request){

        $update = CmsMenus::where('id',$request->id)->update([
            'name'              => $request->name,
            'icon'              => $request->icon,
            'cms_modules_id'    => $request->cms_modules_id,
            'parent_id'         => $request->parent_id,
            'url'               => $request->url,
            'main_folder'       => $request->main_folder,
            'sub_folder'        => $request->sub_folder,
            'status'            => $request->status,
            'sorter'            => $request->sorter,
            'type'              => $request->type,
        ]);

        if($request->type == 'full module'){
            $delete = Nfs::updateAllMenusRelasi($request->id);

            $update = Nfs::createDeafultValue($request->id);
        }else{
            $delete = Nfs::updateAllMenusRelasi($request->id);

            $update = Nfs::createDeafultValueOnlyMenu($request->id);
        }

        return $update;

    }
}
