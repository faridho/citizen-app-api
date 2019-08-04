<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Helpers\ReturnHelper as RT;
use App\Http\Model\V1\DocumentModel;
use Validator;

class DocumentController extends Controller
{
    private function setDefaultResponse( $code = 0 , $success_value = false) {
        $this->success = $success_value;
        $this->code = $code;
    }

    public function insertDocument(Request $request) {
        $validator = Validator::make($request->all(), [
            'jenisWarga' => 'required|numeric',
            'warga' => 'required',
            'jenisDokumen' => 'required',
            'keperluan' => 'required'
        ]);

        if ($validator->fails()) {
            $status = 'Validasi';
            $message = $validator->messages();
            $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
        }else{
            
            if(intval($request->input('jenisWarga')) ===  1) {
                $store = array (
                    'warga' => intval($request->input('warga')),
                    'jenis_dokumen' => $request->input('jenisDokumen'),
                    'keperluan' => $request->input('keperluan'),
                    'biaya' => intval(str_replace( ',', '', $request->input('biaya'))),
                    'status' => 1
                );
    
                $request = DocumentModel::insertDocumentWarga($store);
            }else {
                $store = array (
                    'warga_temporary' => intval($request->input('warga')),
                    'jenis_dokumen' => $request->input('jenisDokumen'),
                    'keperluan' => $request->input('keperluan'),
                    'biaya' => intval(str_replace( ',', '', $request->input('biaya'))),
                    'status' => 1
                );
    
                $request = DocumentModel::insertDocumentWargaTemp($store);
            }
            
            if($request) {
                $status = true;
                $message = 'Input Data Permintaan Dokumen Berhasil';
                $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
            }else {
                $status = false;
                $message = 'Gagal Input Data Permintaan Dokumen';
                $this->setDefaultResponse(ResponseHelper::HTTP_BAD_REQUEST);
            }
        }

        $response = null;
        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function getDocumentAll($id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);

        if($id == '0') {
            $response = DocumentModel::getdocumentWarga();
        }else {
            $response = DocumentModel::getdocumentWargaTemp();
        }
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }
    
    public function getDocumentID($tab, $id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);

        if($tab == '0') {
            $response = DocumentModel::getdocumentWargaID($id);
        }else {
            $response = DocumentModel::getdocumentWargaTempID($id);
        }
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }

    public function allGetDocumentID($tab, $id) {
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);

        if($tab == '0') {
            $response = DocumentModel::getdocumentWargaAllID($id);
        }else {
            $response = DocumentModel::getdocumentWargaAllTempID($id);
        }
        
        $status = true;
        $message = count($response) . ' Data Ditemukan';

        $result = RT::getReturn($status, $message, $response);
        return $result;
    }
}
