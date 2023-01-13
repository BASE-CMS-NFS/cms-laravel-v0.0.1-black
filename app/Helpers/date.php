<?php
namespace App\Helpers;

use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Http;
use Image;
 
use Illuminate\Support\Facades\DB;
 
class Date {
   
    public static function addDate($val){
        date_default_timezone_set('Asia/Jakarta');
        $date       = date('Y-m-d');
        $format     = str_replace('-', '/', $date);
        $result     = date('Y-m-d',strtotime($format . "+".$val." days"));

        return $result;
    }

    public static function minDate($val){
        $date = date('Y-m-d');
        $result = date('Y-m-d',(strtotime ( '-'.$val.' day' , strtotime ( $date) ) ));

        return $result;
    }

    public static function now(){

        return date('Y-m-d');
    }

    public static function bulan(){
        $bulan = [     
                ['id' =>'01',
                'bulan' => 'januari'
                ],
                [
                    'id' =>'02',
                'bulan' => 'ferbuari'
                ],
                    [
                    'id' =>'03',
                'bulan' => 'maret'
                ],
                    [
                    'id' =>'04',
                'bulan' => 'april'
                ],
                    [
                    'id' =>'05',
                'bulan' => 'mei'
                ],
                    [
                    'id' =>'06',
                'bulan' => 'juni'
                ],
                    [
                    'id' =>'07',
                'bulan' => 'juli'
                ],
                    [
                    'id' =>'08',
                'bulan' => 'agustus'
                ],
                    [
                    'id' =>'09',
                'bulan' => 'september'
                ],
                    [
                    'id' =>'10',
                'bulan' => 'oktober'
                ],
                    [
                    'id' =>'11',
                'bulan' => 'november'
                ],
                    [
                    'id' =>'12',
                'bulan' => 'desember'
                ],
       ];
        return $bulan;
    }
    
     public static function tahun(){
        $tahun = [     
                [
                'id' =>'2022'
            ],
                [
                'id' =>'2023'
            ],
                [
                'id' =>'2024'
            ],
                [
                'id' =>'2025'
            ],
                [
                'id' =>'2026'
            ],
                [
                'id' =>'2027'
            ],
                [
                'id' =>'2028'
            ],
                [
                'id' =>'2029'
            ],
                [
                'id' =>'2030'
            ],
       ];
        return $tahun;
    }

    public static function label(){
        $bulan = '';
        foreach(Self::bulan() as $key){
            $bulan .= '"'.$key['bulan'].'"'.',';
        }
        return $bulan;
    }

    public static function labelChartMonthById(){
        $id = array_column(Self::bulan(), 'id');
        return $id;
    }


}