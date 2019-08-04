<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class AuthModel extends Model
{
    public static function getLogin($kode_warga, $password) {
        $response = DB::table('kepala_keluarga')
            ->select('*')
            ->where('kode_warga', $kode_warga)
            ->where('password', $password)
            ->first();
        
        return $response;
    }
}
