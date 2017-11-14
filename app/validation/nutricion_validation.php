<?php
namespace App\Validation;

use App\Lib\Response;

class NutricionValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
    
        
        $key = 'sumplemento_nutr';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 4) {
                $response->errors[$key][] = 'Debe contener como mínimo 4 caracteres';
            }
        }

        $key = 'img_nutr';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 27) {
                $response->errors[$key][] = 'Debe contener como mínimo 27 caracteres';
            }
        }



        $key = 'tipo_nutr';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if($value != 'Artificial' && $value != 'Natural') {
                $response->errors[$key][] = 'Se acepta Artificial o Natural';
            }
        }

        $key = 'informacion_nutr';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 4) {
                $response->errors[$key][] = 'Debe contener como mínimo 4 caracteres';
            }
        } 

        $response->setResponse(count($response->errors) === 0);
        return $response;
    }
}