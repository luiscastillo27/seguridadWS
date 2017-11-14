<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\UsuarioValidation,
    App\Middleware\AuthMiddleware;

$app->group('/usuario/', function () {
    $this->get('listar/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuarios->listar($args['l'], $args['p']))
                   );
    });
    
    
    $this->get('obtener/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuarios->obtener($args['id']))
                   );
    });
    
    
    $this->post('actualizar/{id}', function ($req, $res, $args) {
        $r = UsuarioValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuarios->actualizar($req->getParsedBody(), $args['id']))
                   ); 
    });
    
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuarios->eliminar($args['id']))
                   );   
    });
});