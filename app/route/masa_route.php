<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\MasaValidation,
    App\Middleware\AuthMiddleware;

$app->group('/masa-corporal/', function () {
    $this->get('listar/{l}/{p}/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->masa->listar($args['l'], $args['p'], $args['id']))
                   );
    });
    
    $this->get('obtener/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->masa->obtener($args['id']))
                   );
    });

    $this->get('obtenerTodos/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->masa->obtenerTodos($args['id']))
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
                     json_encode($this->model->masa->registrar($req->getParsedBody()))
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
                     json_encode($this->model->masa->actualizar($req->getParsedBody(), $args['id']))
                   ); 
    });
    
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->masa->eliminar($args['id']))
                   );   
    });

    $this->delete('eliminarTodos/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->masa->eliminarTodos($args['id']))
                   );   
    });
});