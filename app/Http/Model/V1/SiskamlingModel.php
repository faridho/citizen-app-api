<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class SiskamlingModel extends Model
{
    public static function insertSiskamling($request) {
        $response = DB::table('siskamling')
                ->insert($request);

        return $response;
    }

    public static function getSiskamling() {
        $response = DB::table('siskamling')->get();
        return $response;
    }

    public static function insertSiskamlingDetail($request) {
        $response = DB::table('personel_siskamling')
                ->insert($request);

        return $response;
    }

    public static function getSiskamlingDetail($id) {
        $response = DB::table('siskamling')
            ->select('siskamling.tgl_siskamling', 'personel_siskamling.*')
            ->join('personel_siskamling', 'siskamling.id', '=', 'personel_siskamling.id_siskamling')
            ->where('siskamling.id', $id)
            ->get();
        return $response;
    }
}
