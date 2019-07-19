<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Helpers\ReturnHelper as RT;
use App\Http\Model\V1\TemporaryModel;
use Validator;

class TemporaryController extends Controller
{
    private function setDefaultResponse( $code = 0 , $success_value = false) {
        $this->success = $success_value;
        $this->code = $code;
    }

    public function insertTemporary(Request $request) {
        $validator = Validator::make($request->all(), [
            'namaLengkap' => 'required',
            'jenisKelamin' => 'required|numeric',
            'identitas' => 'required',
            'jenisIdentitas' => 'required',
            'kewarganegaraan' => 'required',
            'alamat' => 'required',
            'pemilikTempat' => 'required|numeric',
            'tipeTempatSewa' => 'required',
            'hargaSewa' => 'required|numeric',
            'pekerjaan' => 'required'
        ]);

        if ($validator->fails()) {
            $status = 'Validasi';
            $message = $validator->messages();
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }else{
            $store = array (
                'nama_lengkap' => $request->input('namaLengkap'),
                'jenis_kelamin' => intval($request->input('jenisKelamin')),
                'identitas' => intval($request->input('identitas')),
                'jenis_identitas' => $request->input('jenisIdentitas'),
                'kewarganegaraan' => $request->input('kewarganegaraan'),
                'alamat' => $request->input('alamat'),
                'pemilik_tempat' => intval($request->input('pemilikTempat')),
                'tipe_tempat_sewa' => $request->input('tipeTempatSewa'),
                'harga_sewa' => intval(str_replace( ',', '', $request->input('hargaSewa'))),
                'pekerjaan' => $request->input('pekerjaan'),
                'status' => 1
            );
            
            $request = TemporaryModel::insertTemporary($store);
            if($request) {
                $status = true;
                $message = 'Input Data Warga Temporary Berhasil';
                $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
            }else {
                $status = false;
                $message = 'Gagal Input Data Warga Temporary';
                $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
            }
        }

        $response = null;
        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getTemporary() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = TemporaryModel::getTemporary();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getTemporaryDetail($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = TemporaryModel::getTemporaryDetail($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }
}
