<?php
namespace App\Validation;

use App\Lib\Response;

class AuthValidation {
    public static function validate($data) {
        $response = new Response();
        
        
        $key = 'User';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 4) {
                $response->errors[$key][] = 'Debe contener como mínimo 4 caracteres';
            }
        }
        
        $key = 'Pass';
        if(empty($data[$key])){
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];

            if(strlen($value) < 6) {
                $response->errors[$key][] = 'Debe contener como mínimo 6 caracteres';
            }
        }            
        

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}