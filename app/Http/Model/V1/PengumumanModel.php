<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class PengumumanModel extends Model
{
    public static function insertPengumuman($request) {
        $response = DB::table('pengumuman')
                ->insert($request);

        return $response;
    }

    public static function getPengumuman() {
        $response = DB::table('pengumuman')->get();
        return $response;
    }

    public static function getPengumumanId($id) {
        $response = DB::table('pengumuman')->first();
        return $response;
    }
}
