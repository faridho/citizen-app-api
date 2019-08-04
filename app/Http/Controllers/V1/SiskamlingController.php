<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Helpers\ReturnHelper as RT;
use App\Http\Model\V1\SiskamlingModel;
use Validator;

class SiskamlingController extends Controller
{
    private function setDefaultResponse( $code = 0 , $success_value = false) {
        $this->success = $success_value;
        $this->code = $code;
    }

    public function insertSiskamling(Request $request) {
        $validator = Validator::make($request->all(), [
            'tglSiskamling' => 'required',
            'jamMulai' => 'required',
            'jamBerakhir' => 'required'
        ]);

        if ($validator->fails()) {
            $status = 'Validasi';
            $message = $validator->messages();
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }else{
            $store = array (
                'tgl_siskamling' => $request->input('tglSiskamling'),
                'jam_mulai' => $request->input('jamMulai'),
                'jam_berakhir' => $request->input('jamBerakhir'),
                'rt_rw' => 1,
                'status' => 1
            );
            
            $request = SiskamlingModel::insertSiskamling($store);
            if($request) {
                $status = true;
                $message = 'Input Data Siskamling Berhasil';
                $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
            }else {
                $status = false;
                $message = 'Gagal Input Data Siskamling';
                $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
            }
        }

        $response = null;
        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getSiskamling() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = SiskamlingModel::getSiskamling();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function insertSiskmalingDetail(Request $request) {
        $idSiskamling = intval($request->input('idSiskamling'));
        foreach ($request->input('dataWarga', array()) as $warga) {
            $storeArray = array (
                'id_siskamling' => $idSiskamling,
                'warga' => intval($warga['warga']),
                'status_warga' => $warga['statusWarga'],
                'alasan_status_warga' => $warga['alasan'],
                'status' => 1
            );

            $dataStore = SiskamlingModel::insertSiskamlingDetail($storeArray);
        }

        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);

        $status = true;
        $message = 'Data Personel Siskamling Berhasil Disimpan';
        $response = null;

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getSiskamlingID($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = SiskamlingModel::getSiskamlingDetail($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getSiskamlingIDSingle($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = SiskamlingModel::getSiskamlingId($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }  
    
    public function getSiskamlingReport($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = SiskamlingModel::getSiskamlingReport($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

}
