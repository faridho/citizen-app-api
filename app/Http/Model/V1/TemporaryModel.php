<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class TemporaryModel extends Model
{
    public static function insertTemporary($request) {
        $response = DB::table('warga_temporary')
                ->insert($request);

        return $response;
    }

    public static function getTemporary() {
        $response = DB::table('warga_temporary')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'warga_temporary.*')
            ->join('kepala_keluarga', 'warga_temporary.pemilik_tempat', '=', 'kepala_keluarga.id')
            ->get();
        return $response;
    }

    public static function getTemporaryDetail($id) {
        $response = DB::table('warga_temporary')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'warga_temporary.*')
            ->join('kepala_keluarga', 'warga_temporary.pemilik_tempat', '=', 'kepala_keluarga.id')
            ->where('warga_temporary.id', $id)
            ->first();
        return $response;
    }
}
