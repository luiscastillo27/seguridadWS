<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\ContactosValidation,
    App\Middleware\AuthMiddleware;

$app->group('/contactos/', function () {

    $this->get('listarTodos/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->contactos->listarTodos($args['l'], $args['p']))
                   );
    });

    $this->get('listar/{l}/{p}/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->contactos->listar($args['l'], $args['p'] , $args['id'] ))
                   );
    });
    
    $this->get('obtener/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->contactos->obtener($args['id']))
                   );
    });
    
    $this->post('registrar', function ($req, $res, $args) {
        $r = ContactosValidation::validate($req->getParsedBody());
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->contactos->registrar($req->getParsedBody()))
                   ); 
    });


    $this->post('actualizar/{id}', function ($req, $res, $args) {
        $r = ContactosValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->contactos->actualizar($req->getParsedBody(), $args['id']))
                   ); 
    });
    
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->contactos->eliminar($args['id']))
                   );   
    });
    
});