<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Helpers\ReturnHelper as RT;
use App\Http\Model\V1\DashboardModel;
use Validator;

class DashboardController extends Controller
{
    private function setDefaultResponse( $code = 0 , $success_value = false) {
        $this->success = $success_value;
        $this->code = $code;
    }

    public function login(Request $request) {
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

            $response = DashboardModel::login($username, $password);
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

    public function getKepalaKeluarga() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = DashboardModel::getKepalaKeluarga();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getWarga($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = DashboardModel::getWarga($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }
    
    public function getGenderChart() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = DashboardModel::getGenderChart();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getAgeChart() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = DashboardModel::getAgeChart();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getJobChart() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = DashboardModel::getJobChart();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }
}
