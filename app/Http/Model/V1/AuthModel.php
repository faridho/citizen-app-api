<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class AuthModel extends Model
{
    public static function getAll() {
        $response = DB::table('rt_rw')->select('nama_pengguna', 'nama_lengkap')->get();
        return $response;
    }

    public static function getLogin($username, $password) {
        $response = DB::table('rt_rw')
            ->select('nama_pengguna', 'nama_lengkap')
            ->where('nama_pengguna', $username)
            ->where('kata_kunci', $password)
            ->first();
        
        return $response;
    }
}
