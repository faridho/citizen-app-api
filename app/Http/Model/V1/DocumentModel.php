<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class DocumentModel extends Model
{
    public static function insertDocumentWarga($request) {
        $response = DB::table('permintaan_dokumen_warga')
                ->insert($request);

        return $response;
    }

    public static function insertDocumentWargaTemp($request) {
        $response = DB::table('permintaan_dokumen_warga_temporary')
                ->insert($request);

        return $response;
    }

    public static function getdocumentWarga() {
        $response = DB::table('permintaan_dokumen_warga')
            ->select('warga.nama_lengkap', 'permintaan_dokumen_warga.*')
            ->join('warga', 'permintaan_dokumen_warga.warga', '=', 'warga.id')
            ->get();
        return $response;
    }

    public static function getdocumentWargaTemp() {
        $response = DB::table('permintaan_dokumen_warga_temporary')
            ->select('warga_temporary.nama_lengkap', 'permintaan_dokumen_warga_temporary.*')
            ->join('warga_temporary', 'permintaan_dokumen_warga_temporary.warga_temporary', '=', 'warga_temporary.id')
            ->get();
        return $response;
    }

    public static function getdocumentWargaID($id) {
        $response = DB::table('permintaan_dokumen_warga')
            ->select('warga.nama_lengkap', 'permintaan_dokumen_warga.*')
            ->join('warga', 'permintaan_dokumen_warga.warga', '=', 'warga.id')
            ->where('permintaan_dokumen_warga.id', $id)
            ->first();
        return $response;
    }

    public static function getdocumentWargaAllID($id) {
        $response = DB::table('permintaan_dokumen_warga')
            ->select('warga.nama_lengkap', 'permintaan_dokumen_warga.*')
            ->join('warga', 'permintaan_dokumen_warga.warga', '=', 'warga.id')
            ->where('warga.kepala_keluarga', $id)
            ->get();
        return $response;
    }

    public static function getdocumentWargaTempID($id) {
        $response = DB::table('permintaan_dokumen_warga_temporary')
            ->select('warga_temporary.nama_lengkap', 'permintaan_dokumen_warga_temporary.*')
            ->join('warga_temporary', 'permintaan_dokumen_warga_temporary.warga_temporary', '=', 'warga_temporary.id')
            ->where('permintaan_dokumen_warga_temporary.id', $id)
            ->first();
        return $response;
    }

    public static function getdocumentWargaAllTempID($id) {
        $response = DB::table('permintaan_dokumen_warga_temporary')
            ->select('warga_temporary.nama_lengkap', 'permintaan_dokumen_warga_temporary.*')
            ->join('warga_temporary', 'permintaan_dokumen_warga_temporary.warga_temporary', '=', 'warga_temporary.id')
            ->where('warga_temporary.pemilik_tempat', $id)
            ->get();
        return $response;
    }
}
