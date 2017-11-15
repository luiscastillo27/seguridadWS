<?php
namespace App\Validation;

use App\Lib\Response;

class SolicitudValidation {
    public static function validate($data) {
        $response = new Response();
        
        $key = 'tokenUser1';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 200) {
                $response->errors[$key][] = 'Debe contener como mínimo 200 caracteres';
            }
        }

        $key = 'tokenUser2';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 200) {
                $response->errors[$key][] = 'Debe contener como mínimo  200 caracteres';
            }
        }

        $response->setResponse(count($response->errors) === 0);
        return $response;
    }
}