<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Helpers\ReturnHelper as RT;
use App\Http\Model\V1\AnggaranModel;
use Validator;

class AnggaranController extends Controller
{
    private function setDefaultResponse( $code = 0 , $success_value = false) {
        $this->success = $success_value;
        $this->code = $code;
    }

    public function insertDanaTetap(Request $request) {
        $validator = Validator::make($request->all(), [
            'jumlahDana' => 'required',
            'tglPencairan' => 'required'
        ]);

        if ($validator->fails()) {
            $status = 'Validasi';
            $message = $validator->messages();
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }else{
            $store = array (
                'jumlah_dana' => intval($request->input('jumlahDana')),
                'tgl_pencairan' => $request->input('tglPencairan'),
                'rt_rw' => 1,
                'status' => 1
            );
            
            $request = AnggaranModel::insertDanaTetap($store);
            if($request) {
                $status = true;
                $message = 'Input Data Dana Tetap Berhasil';
                $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
            }else {
                $status = false;
                $message = 'Gagal Input Data Dana Tetap';
                $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
            }
        }

        $response = null;
        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getDanaTetap() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = AnggaranModel::getDanaAnggaran();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }
    
    public function insertPengeluaranDanaTetap(Request $request) {
        $validator = Validator::make($request->all(), [
            'sumberDana' => 'required',
            'jumlahPengeluaran' => 'required',
            'keterangan' => 'required'
        ]);

        if ($validator->fails()) {
            $status = 'Validasi';
            $message = $validator->messages();
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }else{
            $store = array (
                'sumber_dana' => intval($request->input('sumberDana')),
                'jumlah_pengeluaran' => intval($request->input('jumlahPengeluaran')),
                'keterangan' => $request->input('keterangan'),
                'status' => 1
            );
            
            $request = AnggaranModel::insertPengeluaranDanaTetap($store);
            if($request) {
                $status = true;
                $message = 'Input Data Pengeluaran Dana Tetap Berhasil';
                $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
            }else {
                $status = false;
                $message = 'Gagal Input Pengeluaran Data Dana Tetap';
                $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
            }
        }

        $response = null;
        $result = RT::getReturn($status, $message, $response);
        return $result;
    }


}
