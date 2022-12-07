<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Helper;
class CmsEmails extends Model
{
    use HasFactory;
    protected $table = 'cms_emails';

    protected $fillable = [
        'name',
        'image',
        'slug',
        'subject',
        'content',
        'description',
        'from_name',
        'from_email',
        'cc_email',
    ];

    public static function insertData($request){

        if($request->file('image')){

            $data['image']=Helper::image($request->file('image'),'emails');
        }

        $data['name']=$request->name;
        $data['slug']=$request->slug;
        $data['subject']=$request->subject;
        $data['content']=$request->content;
        $data['from_name']=$request->from_name;
        $data['from_email']=$request->from_email;
        $data['cc_email']=$request->cc_email;
        $data['description']=$request->description;

        $save = CmsEmails::create($data);

        return $save;
    }

    public static function updateData($request){

        $check=CmsEmails::find($request->id);

        if($check->foto){

            if($request->file('image')){
                // delete file before update
                Storage::delete('public/'.$check->image);

                $data['image']=Helper::image($request->file('image'),'emails');
            }
        }else{
            if($request->file('image')){

                $data['image']=Helper::image($request->file('image'),'emails');
            }
        }
    
        $data['name']=$request->name;
        $data['slug']=$request->slug;
        $data['subject']=$request->subject;
        $data['content']=$request->content;
        $data['from_name']=$request->from_name;
        $data['from_email']=$request->from_email;
        $data['cc_email']=$request->cc_email;
        $data['description']=$request->description;
    
        $update=CmsEmails::where('id',$request->id)
            ->update($data);

    return $update;
}
}
