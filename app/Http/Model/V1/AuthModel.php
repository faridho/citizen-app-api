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

    public static function getLoginLeader($username, $password) {
      $response = DB::table('rt_rw')
          ->select('*')
          ->where('nama_pengguna', $username)
          ->where('kata_kunci', $password)
          ->first();
      
      return $response;
  }
}
