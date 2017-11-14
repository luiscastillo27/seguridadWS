<?php
namespace App\Validation;

use App\Lib\Response;

class MensajeValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
    
        
        $key = 'idForeign_corporal';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        }

        $key = 'altura_corporal';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } 

        $key = 'peso_corporal';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        }
        

        $response->setResponse(count($response->errors) === 0);
        return $response;
    }
}