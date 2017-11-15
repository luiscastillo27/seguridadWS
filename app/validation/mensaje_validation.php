<?php
namespace App\Validation;

use App\Lib\Response;

class MensajeValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
    
        
        $key = 'tokenEmirsor';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 200) {
                $response->errors[$key][] = 'Debe contener como mínimo 200 caracteres';
            }
        }

        $key = 'tokenReceptor';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 200) {
                $response->errors[$key][] = 'Debe contener como mínimo 200 caracteres';
            }
        }

        $key = 'mensaje';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 5) {
                $response->errors[$key][] = 'Debe contener como mínimo 5 caracteres';
            }
        }
        

        $response->setResponse(count($response->errors) === 0);
        return $response;
    }
}