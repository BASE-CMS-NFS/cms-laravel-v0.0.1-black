<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Helper;

class CmsSettings extends Model
{
    use HasFactory;

    protected $table = 'cms_settings';

    protected $fillable = [
        'name',
        'value',
        'description',
        'image'
    ];

    public static function insertData($request){

        if($request->file('image')){

            $data['image']=Helper::image($request->file('image'),'settings');
        }

        $data['name']=$request->name;
        $data['value']=$request->value;
        $data['description']=$request->description;

        $save = CmsSettings::create($data);

        return $save;
    } 

    public static function updateData($request){

            $check=CmsSettings::find($request->id);

            if($check->foto){

                if($request->file('image')){
                    // delete file before update
                    Storage::delete('public/'.$check->image);

                    $data['image']=Helper::image($request->file('image'),'settings');
                }
            }else{
                if($request->file('image')){

                    $data['image']=Helper::image($request->file('image'),'settings');
                }
            }
        
            $data['name']=$request->name;
            $data['value']=$request->value;
            $data['description']=$request->description;
        
            $update=CmsSettings::where('id',$request->id)
                ->update($data);

        return $update;
    }
}
