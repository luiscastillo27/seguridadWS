<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\MotivacionValidation,
    App\Middleware\AuthMiddleware;

$app->group('/motivacion/', function () {
    $this->get('listar/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->motivacion->listar($args['l'], $args['p']))
                   );
    });
    
    $this->get('obtener/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->motivacion->obtener($args['id']))
                   );
    });
    
    $this->post('registrar', function ($req, $res, $args) {

        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->motivacion->registrar($req->getParsedBody()))
                   ); 
    });


    $this->post('actualizar/{id}', function ($req, $res, $args) {
        $r = MotivacionValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->motivacion->actualizar($req->getParsedBody(), $args['id']))
                   ); 
    });
    
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->motivacion->eliminar($args['id']))
                   );   
    });
});