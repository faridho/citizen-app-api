<?php

namespace App\Http\Model\V1;

use Illuminate\Database\Eloquent\Model;
use DB;

class DashboardModel extends Model
{
    public static function login($username, $password) {
        $response = DB::table('kelurahan')
            ->select('*')
            ->where('username', $username)
            ->where('password', $password)
            ->first();
        
        return $response;
    }

    public static function getKepalaKeluarga() {
        $response = DB::table('kepala_keluarga')
            ->select('*')
            ->get();
        
        return $response;
    }

    public static function getWarga($id) {
        $response = DB::table('warga')
            ->select('*')
            ->where('kepala_keluarga', $id)
            ->get();
        
        return $response;
    }

    public static function getGenderChart() {
        $response = DB::select("SELECT (select count(jenis_kelamin) from warga where jenis_kelamin = '1') as laki_laki, 
                                        (select count(jenis_kelamin) from warga where jenis_kelamin = '2') as perempuan 
                                FROM warga ORDER BY id DESC LIMIT 1") ;
        return $response;       
    }

    public static function getAgeChart() {
        $response = DB::select("SELECT *, YEAR(CURDATE()) - YEAR(tanggal_lahir) AS age FROM warga") ;
        return $response;       
    }

    public static function getJobChart() {
        $response = DB::select("SELECT (select count(pekerjaan) from warga where pekerjaan = 'Pelajar') as pelajar, 
                                       (select count(pekerjaan) from warga where pekerjaan = 'Mahasiswa') as mahasiswa,
                                       (select count(pekerjaan) from warga where pekerjaan = 'IRT') as irt,
                                       (select count(pekerjaan) from warga where pekerjaan = 'Karyawan Swasta') as karyawan_swasta, 
                                       (select count(pekerjaan) from warga where pekerjaan = 'PNS') as pns,
                                       (select count(pekerjaan) from warga where pekerjaan = 'Wiraswasta') as wiraswasta

                                FROM warga ORDER BY id DESC LIMIT 1") ;
        return $response;       
    }


}
