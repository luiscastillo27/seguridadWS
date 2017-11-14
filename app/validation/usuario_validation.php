<?php
namespace App\Validation;

use App\Lib\Response;

class UsuarioValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
        
        $key = 'tipo_usr';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if($value != '1' && $value != '0') {
                $response->errors[$key][] = 'Valor ingresado no válido';
            }
        }
        
        $key = 'nick_usr';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 4) {
                $response->errors[$key][] = 'Debe contener como mínimo 4 caracteres';
            }
        }


        $key = 'edad_usr';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) > 3) {
                $response->errors[$key][] = 'Debe contener como mínimo 2 caracteres';
            }
        }


        $key = 'sexo_usr';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if($value != 'M' && $value != 'F') {
                $response->errors[$key][] = 'Valor ingresado no válido';
            }
        }
        
        
        $key = 'password_usr';
        if( !$update ){
            if(empty($data[$key])){
                $response->errors[$key][] = 'Este campo es obligatorio';
            } else {
                $value = $data[$key];

                if(strlen($value) < 6) {
                    $response->errors[$key][] = 'Debe contener como mínimo 6 caracteres';
                }
            }            
        } else {
            if(!empty($data[$key])){
                $value = $data[$key];

                if(strlen($value) < 6) {
                    $response->errors[$key][] = 'Debe contener como mínimo 6 caracteres';
                }
            }
        }

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}