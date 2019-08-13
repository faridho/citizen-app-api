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

    public static function insertRetKeamanan($request) {
        $response = DB::table('retribusi_keamanan')
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

    public static function getDataRetribusiKeamanan() {
        $response = DB::table('retribusi_keamanan')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'retribusi_keamanan.*')
            ->join('kepala_keluarga', 'retribusi_keamanan.kepala_keluarga', '=', 'kepala_keluarga.id')
            ->get();
        return $response;
    }

    public static function getDataRetribusiKebersihanID($id) {
        $response = DB::table('retribusi_kebersihan')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'retribusi_kebersihan.*')
            ->join('kepala_keluarga', 'retribusi_kebersihan.kepala_keluarga', '=', 'kepala_keluarga.id')
            ->where('retribusi_kebersihan.id', $id)
            ->first();
        return $response;
    }

    public static function getDataRetribusiKebersihanProfileCash($id) {
      $response = DB::table('retribusi_kebersihan')
            ->select('*')
            ->where('kepala_keluarga', $id)
            ->where('jenis_pembayaran', 'Cash')
            ->get();
        return $response;
    }

    public static function getDataRetribusiKebersihanProfileTransfer($id) {
      $response = DB::table('retribusi_kebersihan')
            ->select('*')
            ->where('kepala_keluarga', $id)
            ->where('jenis_pembayaran', 'Transfer')
            ->get();
        return $response;
    }

    public static function getDataRetribusiKeamananProfileCash($id) {
      $response = DB::table('retribusi_keamanan')
            ->select('*')
            ->where('kepala_keluarga', $id)
            ->where('jenis_pembayaran', 'Cash')
            ->get();
        return $response;
    }

    public static function getDataRetribusiKeamananProfileTransfer($id) {
      $response = DB::table('retribusi_keamanan')
            ->select('*')
            ->where('kepala_keluarga', $id)
            ->where('jenis_pembayaran', 'Transfer')
            ->get();
        return $response;
    }

    public static function getAllDataRetribusiKebersihanID($id) {
        $response = DB::table('retribusi_kebersihan')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'retribusi_kebersihan.*')
            ->join('kepala_keluarga', 'retribusi_kebersihan.kepala_keluarga', '=', 'kepala_keluarga.id')
            ->where('retribusi_kebersihan.kepala_keluarga', $id)
            ->get();
        return $response;
    }

    public static function getDataRetribusiKeamananID($id) {
        $response = DB::table('retribusi_keamanan')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'retribusi_keamanan.*')
            ->join('kepala_keluarga', 'retribusi_keamanan.kepala_keluarga', '=', 'kepala_keluarga.id')
            ->where('retribusi_keamanan.id', $id)
            ->first();
        return $response;
    }

    public static function getAllDataRetribusiKeamananID($id) {
        $response = DB::table('retribusi_keamanan')
            ->select('kepala_keluarga.nama_kepala_keluarga', 'retribusi_keamanan.*')
            ->join('kepala_keluarga', 'retribusi_keamanan.kepala_keluarga', '=', 'kepala_keluarga.id')
            ->where('retribusi_keamanan.kepala_keluarga', $id)
            ->get();
        return $response;
    }
}
