<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class RetribusiModel extends Model
{
    public static function insertRetKebersihan($request) {
        $response = DB::table('retribusi_kebersihan')
                ->insert($request);

        return $response;
    }

    public static function getDataRetribusiKebersihan() {
        $response = DB::table('retribusi_kebersihan')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'retribusi_kebersihan.*')
            ->join('kepala_keluarga', 'retribusi_kebersihan.kepala_keluarga', '=', 'kepala_keluarga.id')
            ->get();
        return $response;
    }
}
