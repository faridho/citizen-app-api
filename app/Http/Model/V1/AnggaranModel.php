<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class AnggaranModel extends Model
{
    public static function insertDanaTetap($request) {
        $response = DB::table('dana_tetap')
                ->insert($request);

        return $response;
    }

    public static function getDanaAnggaran() {
        $response = DB::table('dana_tetap')->get();
        return $response;
    }

    public static function insertPengeluaranDanaTetap($request) {
        $response = DB::table('pengeluaran_dana_tetap')
                ->insert($request);

        return $response;
    }
}
