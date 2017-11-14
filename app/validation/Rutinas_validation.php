<?php
namespace App\Validation;

use App\Lib\Response;

class RutinasValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
        
        $key = 'tipo_re';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if($value != 'Rutina' && $value != 'Ejercicio') {
                $response->errors[$key][] = 'Solo se acepta Rutina o Ejercicio';
            }
        }

        $key = 'clasificacion_re';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if($value != 'Volumen' && $value != 'Definicion') {
                $response->errors[$key][] = 'Solo se acepta Volumen o Definicion';
            }
        }

        $key = 'categoria_re';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if($value != 'Normales' && $value != 'Rapidos') {
                $response->errors[$key][] = 'Solo se acepta Normales o Rapidos';
            }
        }
        
        $key = 'nombre_re';
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