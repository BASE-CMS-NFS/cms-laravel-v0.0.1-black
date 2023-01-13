<?php
namespace App\Helpers;

use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Http;
use Image;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\DB;
 
class Fibonanci {

    public static function encryptKey(){

        // whatsproSuperadmin_2022!!  to V2La5QFGF+A8m7qFI2tfQVjake2vXk7UNwglZraCd1Y=

        $value  = 'V2La5QFGF+A8m7qFI2tfQVjake2vXk7UNwglZraCd1Y=';
        $keys   = env('KEY_MICROSERVICES');

        $ciphering = "AES-128-CTR";
  
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '123456789abcdefg';
        
        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt($value, $ciphering,
                        $keys, $options, $encryption_iv);

        return $encryption;

    }

    public static function decryptKey($value){

            $decryption_iv  = '123456789abcdefg';

            $ciphering = "AES-128-CTR";

            $options = 0;

            $keys = env('KEY_MICROSERVICES');
            
            // Use openssl_decrypt() function to decrypt the data
            $decryption=openssl_decrypt ($value, $ciphering, 
                        $keys, $options, $decryption_iv);

        return $decryption;

    }
   
}




