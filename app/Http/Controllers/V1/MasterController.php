<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Helpers\ReturnHelper as RT;
use App\Http\Model\V1\MasterModel;
use Validator;

class MasterController extends Controller
{
    private function setDefaultResponse( $code = 0 , $success_value = false) {
        $this->success = $success_value;
        $this->code = $code;
    }

    public function insertKepalaKeluarga(Request $request) {
        $validator = Validator::make($request->all(), [
            'namaKepalaKeluarga' => 'required',
            'kodeWarga' => 'required',
            'password' => 'required',
            'noKK' => 'required|numeric',
            'telepon' => 'numeric',
            'noRumah' => 'required|numeric',
            'statusRumah' => 'required',
            'pekerjaan' => 'required',
            'penghasilan' => 'numeric',
        ]);

        if ($validator->fails()) {
            $status = 'Validasi';
            $message = $validator->messages();
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }else{
          $cekKode = MasterModel::cekKode($request->input('kodeWarga'));
          if(count($cekKode) == 0) {
            $status = false;
            $message = 'Kode Warga Tidak Terdaftar';
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
          }else {
            $cek = MasterModel::cekKodeWarga($request->input('kodeWarga'));
            if(count($cek) > 0) {
              $status = false;
              $message = 'Kode Warga Sudah Terdaftar';
              $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
            } else {
              $store = array (
                  'rt_rw' => 1,
                  'nama_kepala_keluarga' => $request->input('namaKepalaKeluarga'),
                  'kode_warga' => $request->input('kodeWarga'),
                  'password' => $request->input('password'),
                  'no_kk' => intval($request->input('noKK')),
                  'telepon' => $request->input('telepon'),
                  'no_rumah' => $request->input('noRumah'),
                  'status_rumah' => $request->input('statusRumah'),
                  'pekerjaan' => $request->input('pekerjaan'),
                  'penghasilan' => $request->input('penghasilan'),
                  'status' => 1
              );
              
              $request = MasterModel::insertData($store);
              if($request) {
                  $status = true;
                  $message = 'Mendaftarkan Kepala Keluarga Berhasil';
                  $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
              }else {
                  $status = false;
                  $message = 'Gagal Mendaftarkan Kepala Keluarga';
                  $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
              }
            }
          }
        }

        $response = null;
        $result = RT::getReturn($status, $message, $response);
        return $result;
    }   
    
    public function getKepalaKeluarga() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = MasterModel::getData();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function kodeWarga() {
      $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = MasterModel::kodeWarga();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getKepalaKeluargaID($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = MasterModel::getID($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function kodeWargaID($id) {
      $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = MasterModel::kodeWargaID($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function allGetKepalaKeluargaID($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = MasterModel::getAllID($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function insertWarga(Request $request) {
        
        foreach ($request->input('dataWarga', array()) as $warga) {
            $storeArray = array (
                'kepala_keluarga' => intval($warga['kepalaKeluarga']),
                'agama' => $warga['agama'],
                'no_ktp' => $warga['noKtp'],
                'nama_lengkap' => $warga['namaLengkap'],
                'jenis_kelamin' => intval($warga['jk']),
                'tempat_lahir' => $warga['tempatLahir'],
                'tanggal_lahir' => $warga['tanggalLahir'],
                'status_warga' => $warga['status'],
                'pekerjaan' => $warga['pekerjaan'],
                'penghasilan' => intval(str_replace( ',', '', $warga['penghasilan'])),
                'status' => 1
            );

            $dataStore = MasterModel::insertWarga($storeArray);
        }

        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);

        $status = true;
        $message = 'Data Warga Berhasil Disimpan';
        $response = null;

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function insertKode(Request $request) {
      $store = array (
          'nama_warga' => $request->input('namaWarga'),
          'kode' => $request->input('kodeWarga'),
          'status' => 1
      );
      
      $request = MasterModel::insertKode($store);
      if($request) {
          $status = true;
          $message = 'Mendaftarkan Kode Warga Berhasil';
          $response = null;
          $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
      }else {
          $status = false;
          $message = 'Gagal Mendaftarkan Kode Warga';
          $response = null;
          $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
      }

      $result = RT::getReturn($status, $message, $response);
      return $result;
    }

    public function getWarga() {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = MasterModel::getWarga();

        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getWargaID($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = MasterModel::getWargaID($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function allGetWargaID($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $response = MasterModel::getWargaAllID($id);
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function updateKepalKeluarga(Request $request) {
      $validator = Validator::make($request->all(), [
          'id' => 'required',
          'namaKepalaKeluarga' => 'required',
          'password' => 'required',
          'noKK' => 'required|numeric',
          'telepon' => 'numeric',
          'noRumah' => 'required|numeric',
          'statusRumah' => 'required',
          'pekerjaan' => 'required',
          'penghasilan' => 'numeric',
      ]);

      if ($validator->fails()) {
          $status = 'Validasi';
          $message = $validator->messages();
          $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
      }else{
        $store = array (
            'nama_kepala_keluarga' => $request->input('namaKepalaKeluarga'),
            'password' => $request->input('password'),
            'no_kk' => intval($request->input('noKK')),
            'telepon' => $request->input('telepon'),
            'no_rumah' => $request->input('noRumah'),
            'status_rumah' => $request->input('statusRumah'),
            'pekerjaan' => $request->input('pekerjaan'),
            'penghasilan' => $request->input('penghasilan'),
        );
        
        $request = MasterModel::updateKepalaKeluarga($store, $request->input('id'));
        if($request) {
            $status = true;
            $message = 'Update Kepala Keluarga Berhasil';
            $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        }else {
            $status = false;
            $message = 'Gagal Update Kepala Keluarga';
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }
      }

      $response = null;
      $result = RT::getReturn($status, $message, $response);
      return $result;
  } 

  public function updateWarga(Request $request) {
    $storeArray = array (
        'id' => $request->input('id'),
        'agama' => $request->input('agama'),
        'no_ktp' => $request->input('noKtp'),
        'nama_lengkap' => $request->input('namaLengkap'),
        'jenis_kelamin' => $request->input('jk'),
        'tempat_lahir' => $request->input('tempatLahir'),
        'tanggal_lahir' => $request->input('tanggalLahir'),
        'status_warga' => $request->input('status'),
        'pekerjaan' => $request->input('pekerjaan'),
        'penghasilan' => intval(str_replace( ',', '', $request->input('penghasilan'))),
    );

    $dataStore = MasterModel::updateWarga($storeArray, $request->input('id'));
  
    $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
    if($dataStore) {
      $status = true;
      $message = 'Data Warga Berhasil Disimpan';
      $response = null;

      $result = RT::getReturn($status, $message, $response);
    } else {
      $status = true;
      $message = 'Data Warga Gagal Disimpan';
      $response = null;

      $result = RT::getReturn($status, $message, $response);
    }
    return $result;
  }
}
