<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Helpers\ReturnHelper as RT;
use App\Http\Model\V1\AuthModel;
use Validator;

class AuthController extends Controller
{
    
    private function setDefaultResponse( $code = 0 , $success_value = false) {
        $this->success = $success_value;
        $this->code = $code;
    }

    public function getLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'kodeWarga' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $status = 'Validasi';
            $message = $validator->messages();
            $response = null;
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }else{
            $kodeWarga = $request->input('kodeWarga');
            $password = $request->input('password');

            $response = AuthModel::getLogin($kodeWarga, $password);
            if($response) {
                $status = true;
                $message = 'Login Berhasil';
            }else{
                $status = false;
                $message = 'Login Gagal. Cek Kode Warga & Password Anda';
            }

            $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        }

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }
}
