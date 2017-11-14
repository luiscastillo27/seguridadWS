<?php
namespace App\Validation;

use App\Lib\Response;

class ContactosValidation {
    public static function validate($data, $update = false) {
        $response = new Response();

        $key = 'duracion_die';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 3) {
                $response->errors[$key][] = 'Debe contener como mínimo  caracteres ( una semana)';
            }
        }

        $key = 'desayuno_die';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 10) {
                $response->errors[$key][] = 'Debe contener como mínimo 10 caracteres';
            }
        }

        $key = 'comida_die';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 10) {
                $response->errors[$key][] = 'Debe contener como mínimo 10 caracteres';
            }
        }

        $key = 'cena_die';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 10) {
                $response->errors[$key][] = 'Debe contener como mínimo 10 caracteres';
            }
        }

        $key = 'tipo_die';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if($value != 'Normal' && $value != 'Extrema') {
                $response->errors[$key][] = 'Solo se acepta Normal o Extrema';
            }
        }

        $key = 'sexo_die';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if($value != 'M' && $value != 'F') {
                $response->errors[$key][] = 'Solo se acepta M o F';
            }
        }
        

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}