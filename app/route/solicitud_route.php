<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\SolicitudValidation,
    App\Middleware\AuthMiddleware;

$app->group('/solicitud/', function () {
    
    $this->post('enviar', function ($req, $res, $args) {
        $r = SolicitudValidation::validate($req->getParsedBody());
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }

        $parametros = $req->getParsedBody();        
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->enviar($req->getParsedBody()))
                   );
    });


    $this->post('aceptar', function ($req, $res, $args) {
        $r = SolicitudValidation::validate($req->getParsedBody());
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }

        $parametros = $req->getParsedBody();        
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->aceptar($req->getParsedBody()))
                   );
    });
    
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->eliminar($args['id']))
                   );   
    });

    $this->get('listar', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->listar($req->getParsedBody()))
                   );   
    });

});