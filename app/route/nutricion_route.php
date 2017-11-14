<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\NutricionValidation,
    App\Middleware\AuthMiddleware;

$app->group('/nutricion/', function () {
    $this->get('listarTodos/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->nutricion->listarTodos($args['l'], $args['p']))
                   );
    });
    
    $this->get('listar/{l}/{p}/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->nutricion->listar($args['l'], $args['p'] , $args['id'] ))
                   );
    }); 

    $this->get('obtener/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->nutricion->obtener($args['id']))
                   );
    });
    
    $this->post('registrar', function ($req, $res, $args) {
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->nutricion->registrar($req->getParsedBody()))
                   ); 
    });


    $this->post('actualizar/{id}', function ($req, $res, $args) {
        $r = NutricionValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->nutricion->actualizar($req->getParsedBody(), $args['id']))
                   ); 
    });
    
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->nutricion->eliminar($args['id']))
                   );   
    });
});