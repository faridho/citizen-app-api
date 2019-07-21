<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Helpers\ReturnHelper as RT;
use App\Http\Model\V1\PengumumanModel;
use Validator;

class PengumumanController extends Controller
{
    private function setDefaultResponse( $code = 0 , $success_value = false) {
        $this->success = $success_value;
        $this->code = $code;
    }

    public function insertPengumuman(Request $request) {
        $validator = Validator::make($request->all(), [
            'judulPengumuman' => 'required',
            'isiPengumuman' => 'required'
        ]);

        if ($validator->fails()) {
            $status = 'Validasi';
            $message = $validator->messages();
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }else{
            
            $store = array (
                'judul_pengumuman' => $request->input('judulPengumuman'),
                'isi_pengumuman' => $request->input('isiPengumuman'),
                'rt_rw' => 1,
                'status' => 1
            );

            $request = PengumumanModel::insertPengumuman($store);
            
            if($request) {
                $status = true;
                $message = 'Input Data Pengumuman Berhasil';
                $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
            }else {
                $status = false;
                $message = 'Gagal Input Data Pengumuman';
                $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
            }
        }

        $response = null;
        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getPengumumanAll() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);

        $response = PengumumanModel::getPengumuman();
       
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getPengumumanID($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);

        $response = PengumumanModel::getPengumumanId($id);
       
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }
}
