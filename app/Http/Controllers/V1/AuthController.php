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

    public function getAll() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = AuthModel::getAll();
        
        $countData = count($response);
        if($countData > 0) {
            $status = true;;
            $message = count($response) . ' Data Ditemukan';
        }else {
            $message = 'Data Tidak Ditemukan';
        }

        $result = RT::getReturn($status, $message, $response);
        
        return $result;
    }

    public function getLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $status = 'Validasi';
            $message = $validator->messages();
            $response = null;
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }else{
            $username = $request->input('username');
            $password = $request->input('password');

            $response = AuthModel::getLogin($username, $password);
            if($response) {
                $status = true;
                $message = 'Login Berhasil';
            }else{
                $status = false;
                $message = 'Login Gagal. Cek Username & Password Anda';
            }

            $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        }

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }
}
