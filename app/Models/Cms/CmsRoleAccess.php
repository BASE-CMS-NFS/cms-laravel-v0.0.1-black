<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsRoleAccess extends Model
{
    use HasFactory;

    protected $table = 'cms_role_access';
    
    protected $fillable = [
        'cms_role_id',
        'cms_menus_id',
        'is_view',
        'is_create',
        'is_edit',
        'is_detail',
        'is_delete',
    ];

    public static function insertData($request){
        $record = $request->all();
        $data   = [];

        CmsRoleAccess::where('cms_role_id',$record['cms_role_id'])->delete();

        for($i=0;$i<count($record['cms_menus_id']); $i++){
            $list['cms_role_id']    = $record['cms_role_id'];
            $list['cms_menus_id']   = $record['cms_menus_id'][$i];
            $list['is_view']        = $record['is_view'][$i];
            $list['is_create']      = $record['is_create'][$i];
            $list['is_edit']        = $record['is_edit'][$i];
            $list['is_detail']      = $record['is_detail'][$i];
            $list['is_delete']      = $record['is_delete'][$i];

            array_push($data,$list);

        }

        $save = CmsRoleAccess::insert($data);

        return $save;

    }
}
