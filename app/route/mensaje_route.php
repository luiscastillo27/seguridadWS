<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\MensajeValidation,
    App\Middleware\AuthMiddleware;

$app->group('/mensaje/', function () {

    $this->get('listarEmi/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->listarEmi($args['id']))
                   );
    });

    $this->get('listarRes/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->listarRes($args['id']))
                   );
    });
    
    $this->get('obtener/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->obtener($args['id']))
                   );
    });
    
    $this->post('enviar', function ($req, $res, $args) {
        $r = MensajeValidation::validate($req->getParsedBody());
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->enviar($req->getParsedBody()))
                   ); 
    });
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->mensaje->eliminar($args['id']))
                   );   
    });


});