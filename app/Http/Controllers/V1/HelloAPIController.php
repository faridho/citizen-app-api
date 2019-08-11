<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;

class HelloAPIController extends Controller
{
   
    private function setDefaultResponse( $code = 0 , $success_value = false) {
        $this->success = $success_value;
        $this->code = $code;
    } 

    public function index(){
        $this->setDefaultResponse(ResponseHelper::HTTP_OK, true);
        $this->success = true;
        $this->message = "Hello";
        
        return $this->json();
    }

}
