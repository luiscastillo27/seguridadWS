<?php
namespace App\Validation;

use App\Lib\Response;

class UsuarioValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
        
        
        $key = 'telefono';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 10) {
                $response->errors[$key][] = 'Debe contener como mínimo 10 caracteres';
            }
        }


        $key = 'nombre';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 3) {
                $response->errors[$key][] = 'Debe contener como mínimo 3 caracteres';
            }
        }

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}