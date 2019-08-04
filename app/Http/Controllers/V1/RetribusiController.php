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

    public function getRetribusiKebersihanID($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = RetribusiModel::getDataRetribusiKebersihanID($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function allGetRetribusiKebersihanID($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = RetribusiModel::getAllDataRetribusiKebersihanID($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function insertRetribusiKeamanan(Request $request) {
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
            
            $request = RetribusiModel::insertRetKeamanan($store);
            if($request) {
                $status = true;
                $message = 'Retribusi Keamanan Berhasil';
                $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
            }else {
                $status = false;
                $message = 'Gagal Melakukan Retribusi Keamanan';
                $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
            }
        }

        $response = null;
        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getRetribusiKeamanan() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = RetribusiModel::getDataRetribusiKeamanan();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getRetribusiKeamananID($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = RetribusiModel::getDataRetribusiKeamananID($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function allGetRetribusiKeamananID($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = RetribusiModel::getAllDataRetribusiKeamananID($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    
}
