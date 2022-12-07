<?php
namespace App\Helpers;

use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Http;
use Image;
use Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
 
class Helper {

    public static function resizeImage($file,$folder){
        $image              = $file;
        $ext                = $file->extension();
        $filename           = Str::random(50).'.'.$ext;

        $lebar_gambar = Image::make($file)->width();
    
        $lebar_gambar -= $lebar_gambar * 50 / 100;
     
        $destinationPath = storage_path().'/app/public'.'/'.$folder;
        $img = Image::make($image->path());
        $img->resize($lebar_gambar, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$filename);
   
        return $folder.'/'.$filename;
    }

    public static function image($file,$folder){

        $ext                = $file->extension();
        
        $filename           = Str::random(50).'.'.$ext;
        $file_path          = 'public/'.$folder;

        $path               =Storage::putFileAs($file_path, $file, $filename);

        return $folder.'/'.$filename;
    }

    public static function deleteImage($location){
        
        $check = Storage::delete('public/'.$location);
        
        return $check;
    }

    public static function upper($str){
        return strtoupper($str);
    }

    public static function uc($str){
        return ucfirst($str);
    }


}