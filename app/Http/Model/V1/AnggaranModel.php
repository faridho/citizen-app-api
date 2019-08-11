<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class AnggaranModel extends Model
{
    public static function insertDanaTetap($request) {
        $response = DB::table('pengeluaran_dana')
                ->insert($request);

        return $response;
    }

    public static function getDanaAnggaran() {
        $response = DB::table('pengeluaran_dana')->get();
        return $response;
    }

    public static function getDanaAnggaranID($id) {
      $response = DB::table('pengeluaran_dana')->where('id', $id)->first();
      return $response;
  }

    public static function insertPengeluaranDanaTetap($request) {
        $response = DB::table('pengeluaran_dana_tetap')
                ->insert($request);

        return $response;
    }
}
