<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\MensajeValidation,
    App\Middleware\AuthMiddleware;

$app->group('/mensaje/', function () {
    $this->get('listar/{l}/{p}/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->listar($args['l'], $args['p'], $args['id']))
                   );
    });
    
    $this->get('obtener/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->obtener($args['id']))
                   );
    });

    $this->get('obtenerTodos/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->obtenerTodos($args['id']))
                   );
    });
    
    $this->post('registrar', function ($req, $res, $args) {
        $r = MasaValidation::validate($req->getParsedBody());
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->registrar($req->getParsedBody()))
                   ); 
    });


    $this->post('actualizar/{id}', function ($req, $res, $args) {
        $r = MasaValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->actualizar($req->getParsedBody(), $args['id']))
                   ); 
    });
    
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->eliminar($args['id']))
                   );   
    });

    $this->delete('eliminarTodos/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->eliminarTodos($args['id']))
                   );   
    });
});