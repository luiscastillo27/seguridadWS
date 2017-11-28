<?php
namespace App\Validation;

use App\Lib\Response;

class MensajeValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
    
        
        $key = 'tokenEmisor';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 120) {
                $response->errors[$key][] = 'Debe contener como mínimo 127 caracteres';
            }
        }

        $key = 'tokenReceptor';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 127) {
                $response->errors[$key][] = 'Debe contener como mínimo 127 caracteres';
            }
        }

        $key = 'mensaje';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 2) {
                $response->errors[$key][] = 'Debe contener como mínimo 2 caracteres';
            }
        }
        

        $response->setResponse(count($response->errors) === 0);
        return $response;
    }
}