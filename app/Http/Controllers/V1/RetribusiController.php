<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Helpers\ReturnHelper as RT;
use App\Http\Model\V1\RetribusiModel;
use Validator;

class RetribusiController extends Controller
{
    private function setDefaultResponse( $code = 0 , $success_value = false) {
        $this->success = $success_value;
        $this->code = $code;
    }

    public function insertRetribusiKebersihan(Request $request) {
        $validator = Validator::make($request->all(), [
            'kepalaKeluarga' => 'required',
            'bulan' => 'required|numeric',
            'tahun' => 'required|numeric',
            'nominal' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            $status = 'Validasi';
            $message = $validator->messages();
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }else{
            $store = array (
                'kepala_keluarga' => intval($request->input('kepalaKeluarga')),
                'bulan' => intval($request->input('bulan')),
                'tahun' => intval($request->input('tahun')),
                'nominal' => intval(str_replace( ',', '', $request->input('nominal'))),
                'status' => 1
            );
            
            $request = RetribusiModel::insertRetKebersihan($store);
            if($request) {
                $status = true;
                $message = 'Retribusi Kebersihan Berhasil';
                $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
            }else {
                $status = false;
                $message = 'Gagal Melakukan Retribusi Kebersihan';
                $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
            }
        }

        $response = null;
        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getRetribusiKebersihan() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = RetribusiModel::getDataRetribusiKebersihan();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    
}
