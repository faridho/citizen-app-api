<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class MasterModel extends Model
{
    public static function insertData($request) {
        $response = DB::table('kepala_keluarga')
                ->insert($request);

        return $response;
    }

    public static function insertKode($request) {
      $response = DB::table('kode_warga')
                ->insert($request);

        return $response;
    }

    public static function getData() {
        $response = DB::table('kepala_keluarga')->get();
        return $response;
    }

    public static function kodeWarga() {
      $response = DB::table('kode_warga')->get();
      return $response;
    }

    public static function getID($id) {
        $response = DB::table('kepala_keluarga')
            ->where('id', $id)
            ->first();
        return $response;
    }

    public static function kodeWargaID($id) {
      $response = DB::table('kode_warga')
            ->where('id', $id)
            ->first();
        return $response;
    }

    public static function getAllID($id) {
        $response = DB::table('kepala_keluarga')
            ->where('id', $id)
            ->get();
        return $response;
    }

    public static function cekKode($id) {
      $response = DB::table('kode_warga')
          ->where('kode', $id)
          ->get();
      return $response;
    }

    public static function cekKodeWarga($id) {
      $response = DB::table('kepala_keluarga')
          ->where('kode_warga', $id)
          ->get();
      return $response;
    }

    public static function insertWarga($request) {
        $response = DB::table('warga')
                ->insert($request);

        return $response;
    }

    public static function getWarga() {
        $response = DB::table('warga')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'warga.*')
            ->join('kepala_keluarga', 'warga.kepala_keluarga', '=', 'kepala_keluarga.id')
            ->get();
        return $response;
    }

    public static function getWargaID($id) {
        $response = DB::table('warga')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'warga.*')
            ->join('kepala_keluarga', 'warga.kepala_keluarga', '=', 'kepala_keluarga.id')
            ->where('warga.id', $id)
            ->first();
        return $response;
    }

    public static function getWargaAllID($id) {
        $response = DB::table('warga')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'warga.*')
            ->join('kepala_keluarga', 'warga.kepala_keluarga', '=', 'kepala_keluarga.id')
            ->where('kepala_keluarga.id', $id)
            ->get();
        return $response;
    }

    public static function updateKepalaKeluarga($request, $id) {
      $response = DB::table('kepala_keluarga')
              ->where('id', $id)
              ->update($request);

      return $response;
    }

    public static function updateWarga($request, $id) {
      $response = DB::table('warga')
              ->where('id', $id)
              ->update($request);

      return $response;
    }

}
