<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\RutinasValidation,
    App\Middleware\AuthMiddleware;

$app->group('/rutinas/', function () {
    $this->get('listarTodos/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->rutinas->listarTodos($args['l'], $args['p']))
                   );
    });

    $this->get('listar/{l}/{p}/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->rutinas->listar($args['l'], $args['p'], $args['id'] ))
                   );
    });
    
    $this->get('obtener/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->rutinas->obtener($args['id']))
                   );
    });
    
    $this->post('registrar', function ($req, $res, $args) {
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->rutinas->registrar($req->getParsedBody()))
                   ); 
    });


    $this->post('actualizar/{id}', function ($req, $res, $args) {
       $r = RutinasValidation::validate($req->getParsedBody());
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->rutinas->actualizar($req->getParsedBody(), $args['id']))
                   ); 
    });
    
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->rutinas->eliminar($args['id']))
                   );   
    });
});